# SUMMARY_EX1.md

## Installation Steps

1. **Clone the Repository:**  
   ```sh
   git clone https://github.com/chrishvg/books_api.git
   cd books_api
   ```

2. **Install Dependencies:**  
   ```sh
   composer install
   ```

3. **Set Up Environment:**  
   ```sh
   php artisan key:generate
   ```

4. **Run the Artisan Command:**  
   ```sh
   php artisan app:info 21824
   ```

5. **Run Tests:**  
   ```sh
   php artisan test
   ```

6. **Run the Laravel Development Server:**  
   ```sh
   php artisan serve
   ```

### Run the http API Endpoint:
- Example request:
  ```sh
  http://127.0.0.1:8000/api/app/21824
  ```

## Scalability
- **Database:** Instead of reading JSON files, store the app and developer data in a database for better scalability.
- **Third-Party API:** Structure the services to fetch data from APIs dynamically, allowing new data sources (like XML) to be added easily.

## What Would I Have Done Differently With More Time?
- **Write More Tests:** Add functional and edge-case tests.
- **Improve Error Handling:** Implement custom exceptions and better error messages.

## Additional Thoughts
- The services are structured in a way that allows easy swapping of data sources (from JSON files to an API or database).