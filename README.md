# firebird-report
Web-based reporting tool for Firebird/Interbase databases.

This is a very early stage web-based Firebird/Interbase reporting tool.
Uses PHP's "ibase_" functions to connect and retrieve data through SQL queries.
There are functions to export to PDF, CSV and XLS built-in. (CSV and XLS export tool made by Jordi Burgos).

"geradores/query-datahora.php" executes statement and fetches data from the database.
interbase_sql_exec() runs the SQL query and returns a PHP array.
"datahora.php" builds the html table based on the array.

"index.php" and "datahora.php" are examples of implementation.
