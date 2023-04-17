Create laravel apis for the following using the database schema provided in SQL section :

1) Returns the travel history of a user
user_id is a mandatory input
Optional parameters: from_date and to_date
Output: json encode of array of objects containing below details ordered by travel date
city_name, from_date, to_date

2) Returns the count of distinct travellers against every city for a given period
from_date and to_date are mandatory inputs
Output: json encode of array of objects containing below details ordered by
traveller_count
city_name, traveller_count

<b>Tech stack used -</b>

Laravel version 6^ , PHP version 7.4.1, XAMPP version 3.2.4
