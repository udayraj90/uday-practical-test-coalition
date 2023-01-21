This is the Practival Test for Coalition technologies from Uday Khuman. Follow the below steps to setup the application in your local.

1) Clone the folder from the Git repository - https://github.com/udayraj90/uday-practical-test-coalition

2) Create the virtual host in your Wamp / Xampp in the "httpd-vhosts.conf" file
Ex. for xamp C:\xampp\apache\conf\extra\httpd-vhosts.conf
virutal host - 
<VirtualHost *:80>
	ServerAlias coalitiontest.local
	DocumentRoot "C:/xampp/htdocs/uday-practical-test/public"
	<Directory "C:/xampp/htdocs/uday-practical-test/public">
        AllowOverride All
		Require all granted
		Order allow,deny
		Allow from all
	</Directory>
</VirtualHost>

3) add the host in your hosts file 
for Ex - for windows the file path will be - C:\Windows\System32\drivers\etc\hosts
add the below line at the end of the file
127.0.0.1 		coalitiontest.local

4) run the below command in your local folder
composer install
npm install
npm run dev

5) create  the database named as "coalition-test" in your localhost

6) run the migration in your local with below command to create the tables
php artisan migrate

7) run the URL as per your virtual host
Ex - http://coalitiontest.local/