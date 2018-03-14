# PHP Dijkstra's Algorithm
The library finds shortest path to the all nodes in the given incidence matrix using Dijkstra's Algorithm.

## Getting Started
1) Download the project from github to your host machine.
2) Go to the folder with project

## Prerequisites
For the successful using you must have:
```
php >= 7.1.0
```
## Installing
You have to perform these steps to get a development env running. Call the command in the console. 
```
cd to/the/project/folder
composer install
```
## Running the tests
It's a good practice to run the tests before using library to make sure everything is OK.
```
phpunit
```

## Basic usage
In the folder with the project call the command. 
```
./bin/console path:find /path/to/matrix.json
```
If you confused what the incidence matrix is then look at the matrix.example.json file.
## License
This project is licensed under the MIT License.