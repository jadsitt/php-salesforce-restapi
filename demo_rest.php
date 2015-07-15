<?php
session_start();

function get_opp_fields($instance_url,$access_token) {
	$url ="$instance_url/services/data/v20.0/sobjects/Opportunity/describe";
	
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER,
          array("Authorization: OAuth $access_token",
              "Content-type: application/json"));
  
  $json_response = curl_exec($curl);
  
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  echo "<br />Status: $status";

  if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
  }
  
  echo "HTTP status $status getting available objects<br/><br/>";

  curl_close($curl);

  $response = json_decode($json_response, true);

  return $response['fields'];
	
}

function get_user_fields($instance_url,$access_token) {
	$url ="$instance_url/services/data/v20.0/sobjects/User/describe";
	
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER,
          array("Authorization: OAuth $access_token",
              "Content-type: application/json"));
  
  $json_response = curl_exec($curl);
  
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  echo "<br />Status: $status";

  if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
  }
  
  echo "HTTP status $status getting available objects<br/><br/>";

  curl_close($curl);

  $response = json_decode($json_response, true);

  return $response['fields'];
	
}

function get_lead_fields($instance_url,$access_token) {
	$url ="$instance_url/services/data/v20.0/sobjects/Lead/describe";
	
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER,
          array("Authorization: OAuth $access_token",
              "Content-type: application/json"));
  
  $json_response = curl_exec($curl);
  
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  echo "<br />Status: $status";

  if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
  }
  
  echo "HTTP status $status getting lead fields<br/><br/>";

  curl_close($curl);

  $response = json_decode($json_response, true);

  return $response['fields'];
	
}

function get_account_fields($instance_url,$access_token) {
	$url ="$instance_url/services/data/v20.0/sobjects/Account/describe";
	
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER,
          array("Authorization: OAuth $access_token",
              "Content-type: application/json"));
  
  $json_response = curl_exec($curl);
  
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  echo "<br />Status: $status";

  if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
  }
  
  echo "HTTP status $status getting available objects<br/><br/>";

  curl_close($curl);

  $response = json_decode($json_response, true);

  return $response['fields'];
	
}

function show_available_objects($instance_url, $access_token) {
	$url = "$instance_url/services/data/v20.0/sobjects/";
	
	echo "<br />URL: $url";
		
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER,
          array("Authorization: OAuth $access_token",
              "Content-type: application/json"));
  
  $json_response = curl_exec($curl);
  
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  echo "<br />Status: $status";

  if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
  }
  
  echo "HTTP status $status getting available objects<br/><br/>";

  curl_close($curl);

  $response = json_decode($json_response, true);

  foreach ((array) $response['sobjects'] as $key => $value) {
    //echo "<br />key: $key" . var_dump($value) . "<br/>";
    
    if ('User' === $value['name']) {
      echo "<br />Label: " . $value['label'] . "<br/>";
      echo "Name: " . $value['name'] . "<br/>";
      echo "Queryable: " . $value['queryable'] . "<br/>";
      echo "Urls: " . var_dump($value['urls']) . "<br/>";
   }
  }

  return "Success";  
}

function get_account_id_by_name($name, $instance_url, $access_token) {
    $query = "SELECT  Id from Account where Name = '$name'";
    $url = "$instance_url/services/data/v20.0/query?q=" . urlencode($query);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo "<br />Status: $status";

    if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
    
    echo "HTTP status $status getting opportunities<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $total_size = $response['totalSize'];

    echo "$total_size record(s) returned<br/><br/>";
    
    if ($total_size > 1) {
      foreach ((array) $response['records'] as $record) {
         echo $record['Id'] . "<br/>";
      }
      echo "<br/>";
      $acc_id = 'More than one';
    }
    elseif ($total_size == 1) {
    	$acc_id = $response['records'][0]['Id'];
    }
	
	return $acc_id;
}

function get_account_id_by_acronym($acronym, $instance_url, $access_token) {
    $query = "SELECT  Id from Account where Acronym__c = '$acronym'";
    $url = "$instance_url/services/data/v20.0/query?q=" . urlencode($query);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo "Status: $status<br />";

    if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
    
    echo "HTTP status $status getting partner account id<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $total_size = $response['totalSize'];

    echo "$total_size record(s) returned<br/><br/>";
    
    if ($total_size > 1) {
      foreach ((array) $response['records'] as $record) {
         echo $record['Id'] . "<br/>";
      }
      echo "<br/>";
      $acc_id = 'More than one';
    }
    elseif ($total_size == 1) {
    	$acc_id = $response['records'][0]['Id'];
    }
	
	return $acc_id;
}

function show_partner_opportunities($partner_acc_id, $instance_url, $access_token) {
    //$query = "SELECT Name, Id, LeadSource, Partner_Account__c, (SELECT Name from Account where Id = '0012000001AIC7wAAH') from Opportunity where LeadSource = 'Partner' and Partner_Account__c != ''";
    $query = "SELECT Name, Account.Name, Amount, CurrencyIsoCode, StageName, CloseDate, Partner_Account__c, Next_Action_Description__c from Opportunity where LeadSource = 'Partner' and Partner_Account__c = '$partner_acc_id' LIMIT 100";
    $url = "$instance_url/services/data/v20.0/query?q=" . urlencode($query);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo "<br />Status: $status";

    if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
  
    echo "HTTP status $status getting opportunities<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $total_size = $response['totalSize'];

    echo "$total_size record(s) returned<br/><br/>";
    echo "Opportunity Name, Client Account Name, Stage, Close date<br/>";
    foreach ((array) $response['records'] as $record) {
    	  $amount = number_format ( $record['Amount'] , 2 );
        echo $record['Partner_Account__c'] . ", " . $record['Name'] . ", " . $record['Account']['Name'] . ", " . $amount . " " . $record['CurrencyIsoCode'] . ", " . $record['StageName'] . ", " . $record['CloseDate'] . ", " ."<br/>";
        echo "Next actions:" . $record['Next_Action_Description__c'] . "<br />";
    }
    echo "<br/>";
}

function show_partner_leads($partner_acc_id, $instance_url, $access_token) {
    //$query = "SELECT Name, Id, LeadSource, Partner_Account__c, (SELECT Name from Account where Id = '0012000001AIC7wAAH') from Opportunity where LeadSource = 'Partner' and Partner_Account__c != ''";
    $query = "SELECT IsConverted, Partner_Account__c, ID, Company, Name, Close_Date__c, CreatedDate from Lead where LeadSource = 'Partner' and Partner_Account__c = '$partner_acc_id' and IsConverted = false ORDER BY CreatedDate DESC LIMIT 100";
    $url = "$instance_url/services/data/v20.0/query?q=" . urlencode($query);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo "<br />Status: $status";

    if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
  
    echo "HTTP status $status getting opportunities<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $total_size = $response['totalSize'];

    echo "$total_size record(s) returned<br/><br/>";
    echo "Opportunity Name, Client Account Name, Stage, Close date<br/>";
    foreach ((array) $response['records'] as $record) {
    	  $amount = number_format ( $record['Amount'] , 2 );
        echo $record['IsConverted'] . ", " . $record['Partner_Account__c'] . ", " . $record['Id'] . ", " . $record['Name'] . ", " . $record['Company'] . ", " . $record['Close_Date__c'] . ", " ."<br/>";
    }
    echo "<br/>";
}

function show_opportunities($instance_url, $access_token) {
    $query = "SELECT Name, Id, LeadSource, Partner_Account__c, (SELECT Name from Account where Id = '0012000001AIC7wAAH') from Opportunity where LeadSource = 'Partner' and Partner_Account__c != ''";
    //$query = "SELECT Name, Id, LeadSource, Partner_Account__c from Opportunity where LeadSource = 'Partner' and Partner_Account__c != ''";
    $url = "$instance_url/services/data/v20.0/query?q=" . urlencode($query);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo "<br />Status: $status";

    if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
  
    echo "HTTP status $status getting opportunities<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $total_size = $response['totalSize'];

    echo "$total_size record(s) returned<br/><br/>";
    foreach ((array) $response['records'] as $record) {
        echo $record['Id'] . ", " . $record['Name'] . ", " . $record['LeadSource'] . ", " . $record['Partner_Account__c'] . "<br/>";
    }
    echo "<br/>";
}

function show_users($instance_url, $access_token) {
    $query = "SELECT Username, Id, Name from User";
    //$query = "SELECT Name, Id, LeadSource, Partner_Account__c from Opportunity where LeadSource = 'Partner' and Partner_Account__c != ''";
    $url = "$instance_url/services/data/v20.0/query?q=" . urlencode($query);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo "<br />Status: $status";

    if ( $status != 200 ) {
      die("<br />Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
  
    echo "HTTP status $status getting opportunities<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $total_size = $response['totalSize'];

    echo "$total_size record(s) returned<br/><br/>";
    foreach ((array) $response['records'] as $record) {
        echo $record['Id'] . ", " . $record['Name'] . ", " . $record['Username'] . "<br/>";
    }
    echo "<br/>";
}

function create_opportunity($name, $partner_acc_id, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Opportunity/";

    $content = json_encode(array("Name" => $name,
                                 "LeadSource" => 'Partner',
                                 "Partner_Account__c" => $partner_acc_id,
                                 "StageName" => '1 - Creation',
                                 "CloseDate" => '2015-09-30'));

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token",
                "Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 201 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
    
    echo "<br />HTTP status $status creating opportunity<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $id = $response["id"];

    echo "New record id $id<br/><br/>";

    return $id;
}

function show_opportunity($id, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Opportunity/$id";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }

    echo "HTTP status $status reading account<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    foreach ((array) $response as $key => $value) {
        echo "$key:$value<br/>";
    }
    echo "<br/>";
}

function update_opportunity_owner($id, $owner_id, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Opportunity/$id";

    $content = json_encode(array("OwnerID" => $owner_id));

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token",
                "Content-type: application/json"));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 204 ) {
        die("Error: call to URL $url failed with status $status, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }

    echo "HTTP status $status updating account<br/><br/>";

    curl_close($curl);
}

function show_accounts($instance_url, $access_token) {
    $query = "SELECT Name, Id from Account LIMIT 100";
    $url = "$instance_url/services/data/v20.0/query?q=" . urlencode($query);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($json_response, true);

    $total_size = $response['totalSize'];

    echo "$total_size record(s) returned<br/><br/>";
    foreach ((array) $response['records'] as $record) {
        echo $record['Id'] . ", " . $record['Name'] . "<br/>";
    }
    echo "<br/>";
}  

function create_account($name, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Account/";

    $content = json_encode(array("Name" => $name));

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token",
                "Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
    
    echo "HTTP status $status creating account<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $id = $response["id"];

    echo "New record id $id<br/><br/>";

    return $id;
}

function show_account($id, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Account/$id";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }

    echo "HTTP status $status reading account<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    foreach ((array) $response as $key => $value) {
        echo "$key:$value<br/>";
    }
    echo "<br/>";
}

function update_account($id, $new_name, $city, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Account/$id";

    $content = json_encode(array("Name" => $new_name, "BillingCity" => $city));

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token",
                "Content-type: application/json"));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 204 ) {
        die("Error: call to URL $url failed with status $status, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }

    echo "HTTP status $status updating account<br/><br/>";

    curl_close($curl);
}

function delete_account($id, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Account/$id";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

    curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 204 ) {
        die("Error: call to URL $url failed with status $status, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }

    echo "HTTP status $status deleting account<br/><br/>";

    curl_close($curl);
}

function create_lead($partner_acc_id, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Lead/";
    
    date_default_timezone_set('Europe/Madrid');

	$first_name = 'Javier';
	$last_name = 'Salado';
	$email = 'javier.salado@optimyth.com';
	$phone = '+34916347084';
	$company_name = 'Optimyth';
	$country = "United States";
	$decision_maker_name = 'The Jeeeeesus...';
	$description = '';
	$partner_contact_agent = 'Oswaldo Perote';
	$subscription_type = 'Enterprise';
	$lead_source = 'Partner';
	$close_date = date('Y-m-d',strtotime("3 months"));


    $content = json_encode(array("FirstName" => $first_name,
                                 "LastName" => $last_name,
                                 "Phone" => $phone,
                                 "Email" => $email,
                                 "Company" => $company_name,
                                 "Country" => $country,
                                 "Description" => $description,
                                 "LeadSource" => $lead_source,
                                 "Partner_Account__c" => $partner_acc_id,
                                 "Partner_Contact_Agent__c" => $partner_contact_agent,
                                 "Decission_Maker_Full_Name__c" => $decision_maker_name,
                                 "Kiuwan_Opportunity__c" => 1,
                                 "Type_of_Subscription__c" => $subscription_type,
                                 "Close_Date__c" => $close_date));

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token",
                "Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 201 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
    
    echo "<br />HTTP status $status creating lead<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    $id = $response["id"];

    echo "New record id $id<br/><br/>";

    return $id;
}

function show_lead($id, $instance_url, $access_token) {
    $url = "$instance_url/services/data/v20.0/sobjects/Lead/$id";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }

    echo "HTTP status $status reading lead<br/><br/>";

    curl_close($curl);

    $response = json_decode($json_response, true);

    foreach ((array) $response as $key => $value) {
        echo "$key:$value<br/>";
    }
    echo "<br/>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REST/OAuth Example</title>
    </head>
    <body>
        <tt>
            <?php
            $access_token = $_SESSION['access_token'];
            $instance_url = $_SESSION['instance_url'];

            if (!isset($access_token) || $access_token == "") {
                die("Error - access token missing from session!");
            }

            if (!isset($instance_url) || $instance_url == "") {
                die("Error - instance URL missing from session!");
            }
            
            /*
            echo "Partner acronym: BSD-MX<br />";
            $partner_acc_id = get_account_id_by_acronym('BSD-MX', $instance_url, $access_token);
            echo "Partner Id: " . $partner_acc_id . "<br />";
            
            $new_lead_id = create_lead($partner_acc_id, $instance_url, $access_token);
            show_lead($new_lead_id, $instance_url, $access_token);
 
            $new_opp_id = create_opportunity('My new opportunity', $partner_acc_id, $instance_url, $access_token);            
            show_opportunity($new_opp_id, $instance_url, $access_token);
            
            $owner_id = "005200000045VTtAAM";
            echo "Changing opp owner to $owner_id";
            update_opportunity_owner($new_opp_id, $owner_id, $instance_url, $access_token);
            echo "Done!";
            show_opportunity($new_opp_id, $instance_url, $access_token);
            */
                     
            echo "Partner acronym: BSD-MX<br />";
            $partner_acc_id = get_account_id_by_acronym('BSD-MX', $instance_url, $access_token);
            echo "Partner Id: " . $partner_acc_id;
            
            show_partner_leads($partner_acc_id, $instance_url, $access_token); 
            echo "<br /><br />";
            show_partner_opportunities($partner_acc_id, $instance_url, $access_token); 
                       
            /*
            show_opportunities($instance_url, $access_token); 

            $acc_fields = get_account_fields($instance_url, $access_token);
            foreach ((array) $acc_fields as $field) {
              echo "<br />Label: " . $field['label'] . "<br/>";
              echo "Name: " . $field['name'] . "<br/>";
            }
            echo "<br/>";
            */
            
            $lead_fields = get_lead_fields($instance_url, $access_token);
            foreach ((array) $lead_fields as $field) {
              echo "<br />Label: " . $field['label'] . "<br/>";
              echo "Name: " . $field['name'] . "<br/>";
            }
            echo "<br/>";
            
            /*
            $opp_fields = get_opp_fields($instance_url, $access_token);
            foreach ((array) $opp_fields as $field) {
              echo "<br />Label: " . $field['label'] . "<br/>";
              echo "Name: " . $field['name'] . "<br/>";
            }
            echo "<br/>";
            
            /*
						show_users($instance_url, $access_token);
						
            $user_fields = get_user_fields($instance_url, $access_token);            
            foreach ((array) $user_fields as $field) {
              echo "<br />Label: " . $field['label'] . "<br/>";
              echo "Name: " . $field['name'] . "<br/>";
            }
            echo "<br/>";
            
            show_available_objects($instance_url, $access_token);
            
            show_accounts($instance_url, $access_token);

            $id = create_account("My New Org", $instance_url, $access_token);

            show_account($id, $instance_url, $access_token);

            show_accounts($instance_url, $access_token);

            update_account($id, "My New Org, Inc", "San Francisco",
                    $instance_url, $access_token);

            show_account($id, $instance_url, $access_token);

            show_accounts($instance_url, $access_token);

            delete_account($id, $instance_url, $access_token);

            show_accounts($instance_url, $access_token);
            */
            ?>
        </tt>
    </body>
</html>