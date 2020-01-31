<?php

//phpinfo();

 
        $userpassword='password';
        $ldap_dn = "cn=read-only-admin,dc=example,dc=com";
        $ldap_con = ldap_connect('ldap.forumsys.com');
        ldap_set_option($ldap_con,LDAP_OPT_PROTOCOL_VERSION,3);
        $bind= @ldap_bind($ldap_con,$ldap_dn,$userpassword);

        if($bind){
            echo "LDAP SuccessFull";
        }else{
            echo "Error";
        }




        

?>