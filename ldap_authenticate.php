<?php

        $ldap_host = "ldap.forumsys.com";
        $ldap_dn = "uid=euclid,dc=example,dc=com";
        $ldap_group = "mathematicians";
        $ldap_usr_dom = '@example.com';
        //$username='riemann';
        $userpassword='password';
        $ldap = ldap_connect('52.87.186.93',389);
        ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
       // ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);
        // validate username and password
        echo $bind = @ldap_bind($ldap, $ldap_dn, $userpassword);
        if($bind){
                echo $filter = "(uid=euclid)";
                //$attr = array("memberof");
                //$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("LDAP lookup failed");
                $result = ldap_search($ldap,"dc=example,dc=com", $filter) or exit("LDAP lookup failed");
                $entries = ldap_get_entries($ldap, $result);

                echo "<pre>";
                print_r($entries);exit();
                ldap_unbind($ldap);
                // check group permission
                foreach($entries[0]['memberof'] as $grps) {
                        if(strpos($grps, $ldap_group)) { $access = 1; break; }
               }
 
             
 
        } else {  
                      echo "error";      
                  }

?>