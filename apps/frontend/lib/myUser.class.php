<?php

class myUser extends aSecurityUser
{

  public function registerGoogleOpenIdUser(GoogleAccount $googleAccount,
                                           $emailAddress)
  {
    //TODO allow only ...@szomszedinfos.hu users
    $sfGuardUser = new sfGuardUser();
    $sfGuardUser->username = $emailAddress;
    $sfGuardUser->email_address = $emailAddress;
    $sfGuardUser->GoogleAccount = $googleAccount;
    $sfGuardUser->save();

    return $sfGuardUser;
  }

}
