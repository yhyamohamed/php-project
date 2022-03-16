<?php

namespace App\Controllers;

use App\Model\Token;


class TokenController
{
    public Token $token;

    public function __construct()
    {
        $this->token = new Token;
        $this->faker = \Faker\Factory::create();
    }

    public function index($user_id)
    {
        return $this->user->getAllUserTokens($user_id);
    }

    public function create($user_id)
    {

        $tokenData = ([
            'user_id' => $user_id,
            'remeber_me_token' =>  $this->generateNewToken(),
            'isused' => true
        ]);
    
        return  $this->store($tokenData);
    }
    // return id or Error 
    public function store($tokenData)
    {
        return $this->token->addToken($tokenData);
    }


    public function searchallUserTokens($user_id)
    {
        $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
        return $this->token->getAllUserTokens($user_id);
    }

    public function searchUnUsedTokens($user_id)
    {
        $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
        return $this->table->findUnusedTokens($user_id);
    }
    public function editOrRenwToken($token_id, $used = false)
    {
        //get user data
        $tokenToEdit = $this->token->getData($token_id);
        if ($tokenToEdit) {
            $tokenData = ([
                'remeber_me_token' =>  $this->generateNewToken(),
                'isused' => $used

            ]);
            $this->update($token_id, $tokenData);
        } else {
            return 'Error invalid id';
        }
    }
    public function update($id, $tokenData)
    {
        return $this->token->updateToken($id, $tokenData);
    }
    public function destroy($id)
    {
        $this->deleteToken();
        return $this->token->delete($id);
    }
    public function deleteByTokenName($token_name)
    {
       $token =  $this->token->findToken($token_name);
        return $this->destroy($token->id);
    
    }
    public function generateNewToken()
    {
        $token = sha1($this->faker->uuid());
        setcookie('remember-me', $token, time() + 60 * 60 * 60, '/');
        return $token;
    }
    public function deleteToken()
    {
        setcookie('remember-me', " ", time() - 60 * 60 * 60, '/');
    }
    public function checkToken ($recievedToken)
    {
        return $this->token->findToken($recievedToken);

    }
}
