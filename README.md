# Gra przeglądarkowa 
 
W projekcie zaimplementowane jest logowanie, rejestracja, odzyskiwanie hasła oraz sama mechanika gry. 

![Logowanie](/img/logowanie.png)
 
*Logowanie*
![Rejestracja](/img/rejestracja.png)
  
Rejestracja
W rejestracji wykorzystano mechanizm CAPTCHA w celu zabezpieczenia przed spamem.
![Odzyskiwanie hasła](/img/haslo1.png)
 
Odzyskiwanie hasła
![Resetowanie hasła](/img/haslo2.png)
 
Resetowanie hasła
 
 
 Do wysyłania e-mail za pomocą PHPMailer’a wykorzystano gmaila dlatego w razie nie przychodzenia wiadomości należy włączyć dostęp do aplikacji mniej bezpiecznych. W grze występuje 4 rodzaje budynków. Zamek pozwala na ulepszanie innych budynków na wyższy poziom. Tartak, który generuje drewno. Kamieniołom, który generuje kamień. Pole, które generuje zboże. Koszary, które pozwalają na rekrutowanie jednostek. 
 
 ![Okno gry](/img/gra.png)
 
Okno gry
 
![Pole](/img/pole.png)
 
Pole
 
Za atakowanie innych graczy zdobywamy punkty chwały. Jako przeciwnika mamy do wyboru jednego z 5 najbliższych graczy w rankingu. Przy atakuj siła graczy jest liczona według następującego wzoru: ilość wojowników + ilość łuczników *4.
 ![Ranking](/img/ranking.png)
Ranking
W rankingu znajduje się top 100 graczy pod względem punktów chwały.
 ![Administracja](/img/panel.png)
Administracja
Dane do istniejącego konta administratora to login admin a hasło @dmin234. Będąc zalogowanym jako administrator mamy możliwość banowania i odbanowywania użytkowników. Do szybszego wyszukiwania graczy służy odpowiednie pole tekstowe.
 ![Ban](/img/ban.png)
Komunikat zablokowanego użytkownika.
