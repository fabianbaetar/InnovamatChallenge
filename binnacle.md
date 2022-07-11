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
- 