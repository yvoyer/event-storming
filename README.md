# event-storming
Tool to write Event / commands using the Event storming principle

This cli tool was created based on the [Book](https://www.eventstorming.com/) by Alberto Brandolini.

The goal of this project is to allow the user to create all concepts in the cli tool, 
while saving the data in a file formatted for Importation (TODO later) in order to use the UI project (TODO).


## Installation 

Using [git](https://git-scm.com/), clone the project, and install it using [Composer](https://getcomposer.org/).

```
git clone git@github.com:yvoyer/event-storming.git
cd event-storming
composer install
```  

### Running the cli tool

Create your events using `bin/console "The event that occured"`. From there, you may either answer
the tool questions, or use the options found in `bin/console --help`.

## Generated file

The file that stores the event metadata is located at the root of your folder in `events.json`.
