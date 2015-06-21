/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Object that handles RSA encryption and submission of the FE login form
 */
IsbFrontendLoginFormRsaEncryption = function() {

	var isbRsaFrontendLogin = function(form, publicKeyEndpointUrl) {

        /**
         * Submitted form element
         */
        this.form = form;

        /**
         * XMLHttpRequest
         */
        this.xhr = null;

        /**
         * Endpoint URL to fetch the public key for encryption
         */
        this.publicKeyEndpointUrl = publicKeyEndpointUrl;

        /**
         * Field in which users enter their password
         */
        this.userPasswordField = form.pass;

        /**
         * Field in which system writes rsa key
         */
        this.rsaField = form.rsa;


        /**
         * Uses the public key with the RSA library to encrypt the password.
         *
         * @param publicKeyModulus
         * @param exponent
         */
        this.encryptPassword = function(publicKeyModulus, exponent) {
            var rsa, encryptedPassword;

            rsa = new RSAKey();
            rsa.setPublic(publicKeyModulus, exponent);
            encryptedPassword = rsa.encrypt(this.userPasswordField.value);

            // replace password value with encrypted password
            this.userPasswordField.value = hex2b64(encryptedPassword);
            $.ajax({
                async: 'true',
                url: 'index.php',
                type: 'POST',
                data: {
                    eID: "catenologin",
                    request: {
                        pluginName:  'Pi1',
                        controller:  'Login',
                        action:      'authenticate',
                        arguments: {
                            'pass': encryptedPassword,
                            'user': user
                        }
                    }
                },
                //dataType: "json",
                dataType: 'html',

                success: function(result) {
                    console.log(result);
                    $('#result').html(result);
                },
                error: function(error) {
                    console.log(error);
                    $('#result').html((error.responseText));
                }
            });
            return false;

        };

    }

    this.prepareForm = function(form, publicKeyEndpointUrl){
        if (!form.isbRsaFrontendLogin) {
            form.isbRsaFrontendLogin = new isbRsaFrontendLogin(form, publicKeyEndpointUrl);
        }
        var url = publicKeyEndpointUrl;
        $.ajax({
            url: publicKeyEndpointUrl,
            //dataType: "json",
            dataType: 'html',

            success: function(result) {
                console.log(result);
                var publicKey = result;

                form.isbRsaFrontendLogin.rsaField.value = publicKey;

            },
            error: function(error) {
                console.log(error);
                $('#loginDialog').html((error.responseText));
            }
        });

    }

    this.encryptPassword = function(form){
        var ret = false;
        if (!form.isbRsaFrontendLogin) {
            alert("Form ist nicht initialisiert!");
            return ret;
        }
        var rsa =   form.isbRsaFrontendLogin.rsaField.value;
        var publicKey = rsa.split(':');
        if (publicKey[0] && publicKey[1]) {
            form.isbRsaFrontendLogin.encryptPassword(publicKey[0], publicKey[1]);
            ret = true;
        } else {
            alert('No public key could be generated. Please inform your TYPO3 administrator to check the OpenSSL settings.');
        }
        return ret;
    };


	return this;
}();

