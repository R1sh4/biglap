<?php
class CMail{
    public $PersonName = '';
    public $PersonSurname = '';
    public $Number = '';
    public $Info = '';
    public $email = '';
    
    function __construct($PersonName, $PersonSurname, $Number, $Info, $email) {
        $this->PersonName = $PersonName;
        $this->PersonSurname = $PersonSurname;
        $this->Number = $Number;
        $this->Info = $Info;
        $this->email = $email;
    }
    
    function sendMail() {
        $err = array();
        if (strlen($_POST['PersonName']) < 2) {
            $err['PersonNameLen'] = 'Длина имени должна быть не менее 2-х символов';
        }
           if (preg_match('/\d/',$_POST['PersonName']) != false) {
            $err['PersonNameNum'] = 'В имени не должно быть цифр';
        }
        if (strlen($_POST['PersonSurname']) < 2) {
            $err['PersonNameSurnameLen'] = 'Длина фамилии должна быть не менее 2-х символов';
        }
           if (preg_match('/\d/',$_POST['PersonSurname']) != false) {
            $err['PersonNameSurnameNum'] = 'В фамилии не должно быть цифр';
        }
        if (strlen($_POST['Number']) != 10) {
            $err['NumberLen'] = 'Длина номера должна быть 10 цифр';
        }
           if (!preg_match('/^[0-9]{10,10}+$/',$_POST['Number'])) {
            $err['NumberSymbol'] = 'В номере должны быть только цифры';
        }
        if (!preg_match('/^[a-zA-Z]\w*@[a-zA-Z]\w*\.[a-zA-Z]+$/',$_POST['email'])) {
            $err['email'] = 'Не корректный email';
        }
        if(count($err) == 0)
        {
            $to      = 'kirri97@mail.ru';
            $subject = 'Заявка на котенка';
            $message = 'Имя: ' . $_POST['PersonName'] . "\r\n" .
                'Фамилия: ' . $_POST['PersonSurname'] . "\r\n" .
                'Номер телефона: ' . $_POST['Number'] . "\r\n" .
                'О себе: ' . wordwrap($_POST['Info'], 70, "\r\n") . "\r\n" ;
            $headers = 'From: ' . $_POST['email'] . "\r\n" .
                'Reply-To: ' . $_POST['email'] . "\r\n" .
                'charset: UTF-8' . "\r\n" ;


            $m = mail($to, $subject, $message, $headers);
        }
        $result['err'] = $err;
        $result['add'] = $m;
        return $result;
    }
}
?>