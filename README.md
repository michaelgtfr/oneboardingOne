# OneboardingOne

Link for the backlog on Trello: https://trello.com/b/raJCNe30

## Context 

Order:
  - Install Symfony 4, and create a “Contact Form” page there  
  - Request inputs (last name, first name, email, message) using a Symfony Form  
and to branch, and save this information each time you send it
  - Submit in this form, a drop-down list proposing the departments of
the company (Management, rh, com, dev, ...), previously registered in the database data via a Fixture class  
  - Each time the contact form is submitted, generate an email containing the information, and send this email to the manager of the chosen department  
  - Put the code on a Github repository   

## Installation 
### Prerequisites

  - PHP 7.1 min.  
  - Knowing how to use Symfony 4 and this libraries.  
  - MySQL 8.0.  

### Recover the Application

Clone app URL at the top right.
In the root folder right click the mouse and then press git bash (or equivalent software).
Open software write ` git clone <url cloned> `. The application is download.

### Download libraries via composer

Go to the root folder of the site. 
In the root folder right click the mouse and then press git bash (or equivalent software). 
Open software write ` composer install` . The libraries will be installed automatically in a vendor folder.


## Use
### Creation of the database

Now that your connection parameters are setup, Doctrine can create the db_name database for you:

    php bin/console doctrine:database:create
    
A migration file already exists, you just have to write the command below and validate.

    php bin/console doctrine:migrations:migrate
    
The database is ready.

### Fixture

The fixture data is created in the AppFixture file, save in the DataFixture folder. For save the data in the Bdd, validate the commande below

    php bin/console doctrine:fixtures:load
    
The data is saved.

### Mailer

Be careful in the .env file, the basic configuration and a fictitious smtp for local use with software recovering all messages passing through the requested port. Example of "Papercut" software.  
