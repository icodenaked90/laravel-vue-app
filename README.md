Purchase Trucks Feature - README

Hello, and thanks for reviewing my test.

I have been working for approximately 7 hours, implementing most of the desired functionality for the "Purchase Trucks" feature. I want to provide a fair warning: I have little experience with Vue-related work, so I had to freestyle a lot of the frontend. Despite this, I hope my dedication shines through.

It's been almost a year since I last looked at Laravel backend, but as soon as the first connection to the frontend was working, I got the hang of it again.

I created a simple one-page frontend with Vue, communicating through API routes to the backend using axios (I know there might be smarter ways to do this).

Time Table:
2 hours: Setting up the connection route for login/register, recalling Laravel commands, and connecting it with Vue. Ensuring only authenticated users can use the functions.

1 hour: Writing frontend forms and button functions, ensuring all functionality calls specific routes (e.g., fetch vehicles or fetch user cash).

30 minutes: Writing backend controllers functions.

1 hour: Figuring out how to add migrations for the user table, vehicle table, and user vehicle tables.

1 hour and 30 minutes: Testing connections between frontend and backend, fixing mistakes.

1 hour: Adding seeding for better testing, cleaning up the code, and making it more presentable. Styling a little on the frontend.

Total time spent: 7 hours (approx)

Features within the application:
Login/register/logout functions
Session tokens for authenticated users
Input and state validation
Seeders for generating (users, vehicles)
Amount of cash remaining
List of owned trucks
List of available trucks for purchase
Features that didn't make it:
Sell trucks (should be easy to implement)
Customize trucks (might require reworking the database table)
Filtered data (with more time, it should be achievable)
Optimize for heavy load and big tables (testing with a large amount of data was not possible within the time frame)
I hope to hear from you soon so I can learn from this test.

Best Regards,

Simon