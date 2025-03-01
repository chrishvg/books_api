#!/bin/bash

# Archivos de entrada y salida
SOURCE_FILE="$1"
CATALOG_FILE="$2"
OUTPUT_FILE="$3"

# Crear un archivo temporal para almacenar los IDs no coincidentes
TEMP_FILE=$(mktemp)

# Cargar todas las URLs del catálogo en memoria para búsqueda rápida
declare -A CATALOG_URLS
while IFS= read -r line; do
    CATALOG_URLS["$line"]=1
done < "$CATALOG_FILE"

# Función para procesar una sola línea del archivo fuente
process_line() {
    IFS=, read -r ID_STORE PUBLISHER_URL <<< "$1"

    # Verificar si la URL está en el catálogo exacto (búsqueda rápida)
    if [[ -n "${CATALOG_URLS[$PUBLISHER_URL]}" ]]; then
        return
    fi

    # Si no está en el catálogo, usar búsqueda aproximada con tre-agrep
    BEST_MATCH=$(tre-agrep -s -i -w -B 85% "$PUBLISHER_URL" "$CATALOG_FILE" | head -n 1)

    # Si no hay coincidencias, guardar el ID
    if [ -z "$BEST_MATCH" ]; then
        echo "$ID_STORE" >> "$TEMP_FILE"
    fi
}

export -f process_line
export CATALOG_FILE TEMP_FILE
export -A CATALOG_URLS

# Procesar el archivo fuente en paralelo
cat "$SOURCE_FILE" | tail -n +2 | xargs -P 4 -I {} bash -c 'process_line "{}"'

# Mover el archivo temporal al archivo de salida final
mv "$TEMP_FILE" "$OUTPUT_FILE"