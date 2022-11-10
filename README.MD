# Debugging
## Prerequisite
Install xdebug for your php version, or make it avalible in the docker container at port 9003.

If you're installing xdebug on your system dont forget to add the file:

`/usr/local/etc/php/<php-version>/conf.d/ext-xdebug.ini`
```
[xdebug]
zend_extension="xdebug.so"
xdebug.mode=debug
xdebug.client_host = 127.0.0.1
xdebug.client_port = 9003
xdebug.start_with_request=yes
xdebug.log="/var/log/nginx/xdebug.log"
xdebug.idekey = VSCODE
xdebug.discover_client_host=false
```

and remove `zend_extension="xdebug.so"`from your `php.ini`
<br />
<br />

To switch xdebug on or off, you can install this script:
```bash
curl -L https://gist.githubusercontent.com/rhukster/073a2c1270ccb2c6868e7aced92001cf/raw/c1629293bcf628cd6ded20c201c4ef0a2fa79144/xdebug > /usr/local/bin/xdebug
chmod +x /usr/local/bin/xdebug
```
and use it with `xdebug <on/off>`

## Plugins:

You need the following VSCode Plugins:
`xdebug.php-debug` and `TheNouillet.symfony-vscode`

## Settings
If you want to debug the Storefront javascript, change the url in `.vscode/launch.json` from `test.emz`to your hot-proxy url.

# Auto Complete
For using autocomplete in your plugin for all Shopware js classes and objects, your Plugin needs to be located at: `<web_root>/custom/<plugin-type>/<plugin-name>`

To enable autocomplete for php, you need the following plugin: `bmewburn.vscode-intelephense-client`


__You have to open the plugin-root folder in a seperate VSCode instance for all debug and autocompletion to work properly__