# MusicHub

A music discovery website/catalog built as a project for systems integration at NJIT.

### Prerequisites

These directions are written assuming the user is running Ubuntu Server 18.04.

Get these dependencies/requirements: (Front End/Database/RabbitMQ)
```
sudo apt-get install php apache2 php-bcmath php-mbstring composer php-curl

sudo apt-get install php mysql-server php-bcmath php-mbstring composer php-curl

sudo apt-get install php rabbitmq-server php-bcmath php-mbstring composer php-curl

composer require php-amqplib/php-amqplib
```

Enable rabbitmq_management_plugin and open RabbitMQ management interface in a web browser:
```
sudo systemctl enable rabbitmq-server
sudo systemctl start rabbitmq-server
sudo rabbitmq-plugins enable rabbitmq_management
```

### Installing

1. Import database file into MySQL.

2. Edit `host.ini`, `registration.ini`,  `login.ini`.

3. Copy all project files from the front end folder to the `/var/www/html` directory.

4. Database: Run the receiver scripts.

5. Use a web browser to view and test the project.

## Authors

See the list of [contributors](https://github.com/adr50/MusicHub/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
