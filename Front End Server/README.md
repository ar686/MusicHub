# MusicHub

A music discovery website/catalog built as a project for systems integration at NJIT.

### Prerequisites

These directions are written assuming the user is running Ubuntu Server 18.04.

Get these dependencies/requirements:
```
sudo apt-get install php apache2 rabbitmq-server php-bcmath php-mbstring composer
```
Enable rabbitmq_management_plugin and open RabbitMQ management interface in a web browser:

```
sudo update-rc.d rabbitmq-server defaults
sudo service rabbitmq-server start```

### Installing

1. Import database file into MySQL.

2. Edit *host.ini*, *registration.ini*,  *login.ini*, *dbconfig.php* to modify host/database information.

3. Copy all project files to the */var/www/html* directory.

4. Inside the */var/www/html* directory, run the receiver .php scripts.

5. Use a web browser to view and test the project.

## Authors

See the list of [contributors](https://github.com/adr50/MusicHub/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.