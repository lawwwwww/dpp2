How To Get All Files From GitHub:
***********************************************************************************************
*We are using XAMPP to host everything so you need to start the Apache and MySQL from the XAMPP Control panel

Github:
-go to => https://github.com/lawwwwww/dpp2 and clone the file
-move the file to htdocs in your XAMPP folder

Importing the database:
-go to => http://127.0.0.1/phpmyadmin/
-Then create new database named "cafedb".
-go to import then select the sql files from a folder named "Models" and click 'Go' after every upload.
*Database contains 5 tables.
***************************************************************************************************

Get Into The Website:
*******************************************************
-visit http://localhost/dpp2/LoginRegister/
-For new members click on sign up
*clicking on "Already a member" leads to sign in page.
*******************************************************

Sign In To Admin Side:
**************************************************************************************************************************************************
Email:rob@gmail.com
Password:123456789
*'HOME' leads back to admin home page.
*'MANAGE' shows a list of 3 options to manage menu, tables and employees. From here you can add, edit and delete the menu, tables and employees.
  - In 'MANAGE MENU', images added through upload the image file to the folder and enter the same file name as the images' file.
*'PAYMENT' show transaction list, transaction log and order list.
*'TRANSACTION LIST' contains all payment details.
*'ORDER LIST' show order details. 
*'TRANSACTION LOG' contains a summary from both order and transaction lists.
*From the transaction list page you can access the 'daily summary report'.
*Order list will has data after user takes an order, transaction list will fetch data from payment table after make a payment. After these two processes done then transaction log can show something.
**************************************************************************************************************************************************

Sign In To Staff Side:
**************************************************************************************************************************************************
Email:bob@gmail.com
Password:12345
*'HOME' leads back to the main page
*'TABLE SUMMARY' is for Adding orders and reservations, this leads to payment too
*'SIGNATURE FOOD' shows popular dish (dish with a lot of orders).
*'LOGOUT' leaves means that you go back to the login/logout side.

To Create New Order or Reservation:
**************************************************************************************************************************************************
-go to 'TABLE SUMMARY' 
-Under the table summary you can choose to either 'Add/View order' or 'Reserve'

'Add/View order' is selected:
 -----------------------------
*The serve status and availability is no and yes respectively, it changes to yes and no if items are added to the cart.
*Then it changes back to no and yes after user pays and clicks on complete transaction to show availability of that table.
*If nothing is added to the cart then status and availability will remain as no and yes respectively
Clicking on the pay button here leads to the payment page:
*In the payment after entering the amount received press enter to view balance.
*The payment page has a minor bug that leads to the value for amount received changing back to the place holder "Enter Amount". The balance produced is still correct.
*Clicking on complete transaction will take you back to main page.
'Reserve' is selected:
 ---------------------
*The reservation form can be used for future dates only. This means that reservations have to be made a day or days before.
*If on the reservation datetime, it will set status to yes and availability to no.
*If reservation date pass, it will delete related reservation automatically.
**************************************************************************************************************************************************