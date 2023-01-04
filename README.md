# Mage2 Module Takemiya U4crypto

    ``takemiya/module-u4crypto``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
U4crypto Payment Method

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Takemiya`
 - Enable the module by running `php bin/magento module:enable Takemiya_U4crypto`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require takemiya/module-u4crypto`
 - enable the module by running `php bin/magento module:enable Takemiya_U4crypto`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - Billet - payment/billet/*

 - Pix - payment/pix/*

 - Creditcard - payment/creditcard/*

 - enable (general/general/enable)


## Specifications

 - API Endpoint
	- POST - Takemiya\U4crypto\Api\OrderStatusManagementInterface > Takemiya\U4crypto\Model\OrderStatusManagement

 - Payment Method
	- Billet

 - Payment Method
	- Pix

 - Payment Method
	- Creditcard


## Attributes



