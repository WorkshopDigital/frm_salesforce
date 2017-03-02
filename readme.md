# Formidable Forms Salesforce Integration
Formidable Forms Salesforce Integration is a WordPress plugin that connects your site's Formidabble Forms to the Salesforce CRM.

## Configuration
The Formidable Forms Salesforce Integration plugin makes it easy to submit leads to your Salesforce CRM account. After installing the plugin you will find a new Salesforce submenu available under your Formidable admin menu. On that page there are two tabs, 1. Configure and 2. Authorize. The configuration tab has instructions on how to create a [Salesforce Connected App](https://help.salesforce.com/articleView?id=connected_app_overview.htm&type=0). This is required to connect your site to Salesforce.

## Authorize
Once you have finished creating your Salesforce Connected App you can then authorize your plugin to use the Salesforce REST API. Make sure you have saved your Client ID and Secret you got when you created your Connected App. Then switch to the Authorize Tab and click the 'Authorize' button. You will be directed to a Salesforce login page. Once you've authorized the app, you will be redirected about to your WordPress Formidable Forms Salesforce Integration admin page. You should see a green check mark in the Authorization Status section. 

## The Formidable Forms Salesforce form action
You can pick and choose which forms send what information to your Salesforce account. To connect a form to Salesforce, select or create the form and edit the form's settings. Under 'Form Actions' there will be a Saleforce option. Click the logo to add the action to the form. There you can map your form's fields to Salesforce's lead fields. There are a few required fields for creating a lead in Salesforce *Company* and *LastName* are required on each and every lead submission. Update your form and you will soon see your leads populate in Salesforce.



