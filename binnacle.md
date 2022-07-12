I decided to create this binnacle to explain how I'm facing this challenge and what are my steps in it.

The first point, after reading all the information from the ```readme.md``` file, I decided to test and try the application.
As I saw, one of the main improvements that would be nice is adding docker to create containers where load the application.
This is also important to avoid dependencies errors or problems related to versions of the libraries.
If I had enough time, this would be one of my first steps, but for now I will try to load the app and see what I can do.

I had to add some dependencies on the composer.json to run the application on my local (with docker, we can avoid that).
When I have the application running, the next step is to analyze the code.
- I see a main controller, with all the endpoints.
- The activity entity, with all properties as public and all the getters and setters of them.
- The fixture of the database.
- Config files.

Then, is the time to decide which things we could do with this code. This is the list of possible actions:
- Fix the entity, leaving the methods only used (getters), remove the unnecessary (setters) and use the correct visibility of the properties (private).
- Move the logic from the controller to a more appropriate structure.
- Add routes to their correspondent config file ```routes.yaml```.
- Adding testing (unit and acceptance tests) for our logic.

My wish list if I had time for doing it and not only 2-3 hours:
- Add DDD to the project.
- Add CQRS to the project.

When I had some ideas wrote and thought for the code without seeing it in a more depth way (I only saw the structure and not the logic),
I started to add the routes and move them from the controller.

When I did this point, I decided that it could be a good idea to have this binnacle for understanding better my decisions.

My next points will be fixing the entity and move the first endpoint from the main controller.
- I see that the same endpoint ```/activites``` is used for get all the activities and save a new activity. 
I decided to separate in two different endpoints because they are different actions.
- When I'm separating the endpoints, I decided to do a DDD with CQRS approach for this project.
It's only an approach because, in this case, we will don't have any bus to send our commands and queries but, in an iterative solution, which is what I'm proposing, it would be nice to have the code with this structure.
- Command and Query classes are used as DTOs.
- I decided to separate into different controllers each endpoint.
- If I had more time I would make a correct process of error messages in the application (exceptions) and returns (responses) to the user.

I changed the endpoint for adding activities, which was in the same function that get all activities, and I modify the readme entry.
At this time, I decided to finish my work, but I will explain the things I would do and what would be nice to have:
 - The first point, adding some testing. In this case, I would add some acceptance tests of the endpoints that I did.
Unit testing would be nice, but in the first two endpoints the logic is very simple and the testing it's not mandatory from my point of view.
 - I analyzed the ```registerActivity``` endpoint, and I saw 2 different actions: 
   - First, get the stored solution of that activity and check the score of the given solution.
   - Second, store the solution given by the user.
 - So, for doing the refactor, I would create a query to obtain the solutions and a command to store the answer (different actions).
 - The last endpoint, ```nextActivity```, has a query to get the information about activities and their score.
In this case, maybe I would propose to think a better solution to store the data into the database.
Having the scores is important, but if we need only to know the last activity done to know which is the next we can improve our data structure and how it's stored.
For example, a solution could be having a redis database which stores the last activity done by the user and the next to be done.
Faster access, only to the data we need, no logic... And in the case that we are registering a new answer, if we use events, we could send an event when we have a new solution and checks if we need to update the last activity done and the next or not.
 - For both endpoints, as they have more business logic, testing is a must.
 - At this moment, we would have a more readable code, easier to modify and maintain, easy to implement CQRS, that talk about business thank you to DDD...
The next step would be, adding the bonus (that would be, checking the time of the answer at the ```nextActivity``` endpoint).

Of course, if the code would be usable in a productive way, my following steps to treat the project would be:
 - Implement docker: this would help developers to work with the code and have a portable project.
 - Implement CQRS: use symfony messages, for example, to manage queries, commands and events.
 - Doctrine: doctrine to manage the database objects in a more efficient way.
 - Use of events: an event-driven architecture to manage significant state changes.

Definitely, with these changes the code would have more flexibility to changes, more efficient, which speaks with business language...
This would be the code I would like to work with :) 