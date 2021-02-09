# HangmanProject
This is a small hangman game project using PHP/Symfony I completed over a weekend with no prior Symfony knowledge as a coding example

Technologies used:
Bootstrap 4, 
Font Awesome 5, 
PHP 8, 
Symfony 5, 
jQuery 3

# Note from Jack Hardy
The hangman project was written just this weekend as a coding example. Based around the idea of the hangman game. I took this challenge of using a framework I had no experience with on as I had not dived into PHP frameworks much, and though I have OOP skills elsewhere I had not used them with PHP. I took Symfony for a ride and came out the other side of the weekend with this fun project.

Please note I am aware of some obvious gaps in my knowledge especially sending information back up to the class from the front end. But to keep to my deadline I chose to use some of my own current knowledge to find unique work arounds all whilst keeping everything as tidy as possible.

# Please note the below is written with Windows systems in mind

To get started you need to set up both PHP 8 and Symfony 5 (along with composer). For PHP follow this link...

https://www.php.net/releases/8.0/en.php

And continue to follow the instructions on installing PHP 8. If using a windows machine please make sure to download the windows variant. The Non Thread Safe will do. Also bear in mind you will need to head over to your control panel and add it to your PATHs (a section on this can be found https://www.php.net/manual/en/faq.installation.php). For Symfony 5 follow this link...

https://symfony.com/download

And follow the instructions to get symfony set up on your system. There is a link for composer within the symfony setup documents here...

https://symfony.com/doc/4.2/setup.html#installing-symfony

With composer when it asks for the PHP command line simply point it to the php.exe found in the location you places the php files. From here jump on to your local flavour of terminal and nativgate to
the directory where you placed this repository e.g. C:\Users\...\Documents\HangmanProject, make sure you are at the top level with the src folder etc within, now run the following command...

<!--This will install any needed packages to run this locally-->
composer install

<!--then this-->

<!--This will start the local server-->
symfony server:start

This will start a small local webserver for this project to run on. By default the standard address is http://127.0.0.1:8000, head on over
to this page and you should be greated with my project home page. Enter your name, DOB and pick a difficulty. Good luck! Please note no 
information is stored this is simply a small coding example.

To stop the local server cmd+c out and use command

symfony server:stop

Any issues please contact me.
