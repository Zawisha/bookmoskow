<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Demystifying Email Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="background-color: #f2f4f7; ">

<table align="center"  cellpadding="0" cellspacing="0" width="600" style="border: 1px solid grey;">
    <table width="100%;">
            <tr align="center" bgcolor="f2f4f7"; style="padding: 40px 0 30px 0;  margin: 5px 5px 5px 5px;">
                <img src="https://i.ibb.co/FJmbZMt/Book-Moscow.png" alt="Books Moscow"  style="display: block;" />
            </tr>
    </table>
    <tr style="background-color: #dfe4eb;">
        <td style="font-size: 14px;padding: 10px;">

            <p>Дорогой друг. Мы рады приветствовать Вас в нашем магазине. И в знак нашей дружбы дарим Вам промокод на 500₽ на первый Ваш заказ от 7000₽.<br>
                Не набираете на 7000?<br>
                Не беда!<br>
                На любой заказ от 1500₽ скидка по  промокоду<br></p>
            <p><b>HELLO - 3%.</b></p>
        </td>
    </tr>

    <tr style="border: 10px dot-dot-dash grey;">
        <a href="https://booksmoscow.ru?utm_source=email&utm_medium=bk&utm_campaign=sk_popup">
            <button  type="button" style="background-color: #70bbd9; border:none; color: white;text-align: center;font-size: large; display: inline-block; width: 100%; height: 70px; ">
                Получить скидку
            </button>
        </a>
    </tr>

    <table style="padding-top: 50px; padding-bottom: 50px;padding-left: 50px;">
        <tr>
        <td align="center" width="170px" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; border-radius: 80%">
            <img src="https://cdn.iconscout.com/icon/free/png-256/man-support-2122174-1786505.png" alt="Support" width="60%" height="40%" style="display: block; align-content: center;" />
        </td>
        <td  style="align-content: left; padding-left: 50px;">
            <b><p>Сергей Загородный</p>
            <p style="font-size: 12px;">Служба заботы о покупателях</p>
            <p>admin@booksmoscow.ru</p>
            <p>+7 (495) 241-00-56</p></b>
        </td>
     </tr>
    </table>
    <tr style="background-color: #dfe4eb;">
        <td style="font-size: 10px;padding: 1px;">
            <p>Если вы не желаете быть в курсе последних акций,
                получать новые бонусы и промокоды - вы можете отписаться от нашей рассылке нажав на кнопку ниже.</p>
        </td>
    </tr>

    <tr style="border: 10px dot-dot-dash grey;">
        <a href="http://okmos.ru/unsub_email/{{ $user_email }}&{{ $email_token }}">
            <button  type="button" style="background-color: #C0C0C0; border:none; color: white;text-align: center;font-size: small; display: inline-block; width: 100%; height: 18px; ">
               Отписаться
            </button>
        </a>
    </tr>
</table>
</body>
</html>