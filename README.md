# laravel-vue-app
Hello, I have been working now for 7 hours (ish), and i have implemented most of the wanted functionality for the “purchase trucks” Feature.
A fair warning! I have never done any vue related work, so i had to freestyle alot of the frontend, but i hope that it still shows my dedication.

Its been almost a year since i last looked at laravel backend, but as soon as the first connection to the frontend was working, it kinda got the hang of it again.

I have created a simple OnePage front end with vue, which communicates via API Routes to the backend using axios(i know there might be smarter ways to do this).

Now for the time table:

2 hours was spend trying to setup the connection route for login/register and remembering how laravel commands was working again and trying my best to connect it with Vue while making sure that only authenticated users were able to use the functions.

1 hour was spend writing the frontend forms and button functions, making sure all of the functionality was calling a specific route(like fetch vehicles or fetchusercash)

30 min was spend writing the backend controllers functions.

1 hour was spend figuring out how to add migrations for both the user table, vehicle table and user vehicle tables.

1 hour and 30 min was spend testing the connections between frontend and backend and fixing the mistakes made.

1 hour was spend adding seeding for better testing and cleaning up the code to make it more presentable and styling a little on the frontend

That concludes 7 hours of work (approx)

The Features within the application:

Login/register/logout functions
Session tokens for authenticated users
input and state validation
Seeders for generating (users, vehicles)
Amount of cash remaining
List of owned trucks
List of availble trucks for purchase

Features that didnt make it:
sell trucks (should be easy to implement)
customize trucks (Would require to maybe rework the database table with possible things to change)
filtered data (with more time i should be able to do it)
Optimize for heavy load and big tables (If i had more time to test it, i could have tested with seeding the database with huge amount of vehicles for example)

I hope to hear from you soon, so i can learn from this test.

Best Regards

Simon





