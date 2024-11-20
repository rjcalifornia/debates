
# DEBATES

Citizen Participation and Open Government plugin for elgg. Inspired by the CONSUL Project: https://consuldemocracy.org/

### Requirements
* PHP 8.2.x
* Composer
* NodeJS
* NPM
* elgg 6.x

## Main Features

This plugin provides a place where anyone can open threads on any subject, creating separate spaces where people can discuss the proposed topic. Debates are valued by everybody, to highlight the most important issues.

The debates module makes it easier for citizens to make visible the issues that seem important to them, and for them to meet each other to debate or collaborate on these issues.  It is a space for listening, but also for citizen gathering. 
Users  can  vote  for  or  against  the  debates,  so  that  the  most  highly  valued  debates  are 
those that are regularly displayed on the main debates page. 


- Create debates
- Users can vote for or against a debate
- Comments section where users can debate with each other
- Highly valued debates will be available in the frontpage
- Select2 integration to display SDGs(Sustainable Development Goals)
- Filter debates by SDG
- Twig as template engine
- Compatible with elgg 6.x

## Installation | Elgg
- Download from the elgg repository
- Unzip in the mod folder
- Place at the bottom of the list and activate it

## Installation | Dev
- Clone this repository
- Run ``` composer install ``` to install the required PHP dependencies
- Run ``` npm install ``` to install BootStrap Icons and Tailwindcss

## Customizing with Tailwind CSS | Dev
- Run  ``` npx tailwindcss -i ./src/input.css -o ./dist/output.css --watch ``` 
- Add the desired Tailwind CSS classes to the ``` index.html ``` file in the ``` src ``` folder

## Dependencies

- [Twig 3.14](https://twig.symfony.com/) - Twig is a modern template engine for PHP
- [BootStrap Icons](https://icons.getbootstrap.com/) - Free, high quality, open source icon library with over 2,000 icons.
- [Tailwind CSS](https://tailwindcss.com/) - A utility-first CSS framework packed with classes to build any design, directly in your markup.
- [Preline](https://preline.co/index.html) - Preline UI is an open-source Tailwind CSS components library for any needs.

## Information

Visit https://sdgs.un.org/es/goals for a details about the SDGs