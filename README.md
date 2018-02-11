# Find your Elf Name

This is the GITHUB project for my first test of a 'share' game for Facebook and Twitter

WHAT IS YOUR ELF NAME? (http://geekwisdom.org/games/elfnames/)

The main idea of the application is to allow the user to enter a name, and a gender, it then genereates throug the shear
awesomeness of 'randomness', a unique elf name, dnd character class, and a brief 'about you background'

I have tried to make the app generic enough so that it can be templated for lots of other purposes.  Note that it
is styled with with the css of the geekwisdom site, but you are free to style it what ever way you want

## Getting Started

This 'game' was written in 'php'. The main files that control it are called elftemplate.dat (which is creates a unqiue
html file each time a name is gnerated) and elfhtml.dat, which is the html that is shown when a user first visits the site)

Besure to edit the elftemplate.dat and replace {YOURAPPID} with your facebook app id to have the Share button work
for you.

This app does not collect any information from the users facebook profile. I did not want to store users photos on the
GeekWisdom.org site which is why they are left out.

The main images used are elfmale.png and elffemale.png which can be customized to meet your needs.



### Prerequisites

This app was tested using PHP5 on a ubuntu linux machine, it was not tested on any other devices, though feel free
to make improvments as needed for our particular situation.## Authors

* **Brad Detchevery** - *@GeekWisdom* - [Twitter](https://twitter.com/@TrueGeekWisdom)

URI: [GeekWisdom.org](http://geekwisdom.org)

## License

This project is licensed under the  GNU GENERAL PUBLIC LICENSE - see the [LICENSE](LICENSE) file for details

## Acknowledgments

* Thanks to archive.org for the ability to store these videos
* SHOUT OUT to the folks at GITHUB for the location to store it