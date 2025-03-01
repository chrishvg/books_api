## How to Run the Code

## Running the Laravel Artisan Command
To execute the duplicate detection process, run the following command:
```bash
php artisan detect:duplicates
```

This command will process the source and catalog publisher URLs and generate an output file with IDs of programs that do **not** exceed the **85% similarity threshold**.

## Running the Tests
To validate the functionality, run the tests using PHPUnit:
```bash
php artisan test
```

## Choice of Script Language
We chose **Bash** for the external script because:
- **Performance**: Bash is highly efficient for processing large text files, leveraging built-in utilities like `awk`, `grep`, and `sort`.
- **Low Overhead**: Compared to a PHP or Python solution, Bash scripts run directly in the shell without requiring additional dependencies.

## What Could Have Been Done Differently With More Time?
- **Refactoring for Maintainability**: Improving code documentation and modularizing the Bash script for better reuse.
- **Better Error Handling**: Ensuring robust exception handling and logging mechanisms to track failures and slowdowns.