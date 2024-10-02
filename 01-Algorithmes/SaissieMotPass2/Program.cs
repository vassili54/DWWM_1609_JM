/*
L'utilisateur entre un mot de passe
Le programme contrôle si le mot de passe respecte les règles en vigueur
- 12 caractères minimum
    ET Au moins 1 minuscule
    ET Au moins 1 majuscule
    ET Au moins 1 chiffre
    ET Au moins 1 caractère spécial
OU
- 20 caractères minimum
    ET Au moins 1 minuscule
    ET Au moins 1 majuscule
    ET Au moins 1 chiffre
*/

using System.Text.RegularExpressions;

string motDePasse;
string regexMinuscules;
string regexMajuscules;
string regexChiffres;
string regexCaracteresSpeciaux;

Console.WriteLine("Saisissez un mot de passe : ");

motDePasse = Console.ReadLine() ?? "";


regexMinuscules = "[a-z]{1,}"; // {1,} = 1 ou plusieurs

regexMajuscules = "[A-Z]+"; // + = 1 ou plusieurs

regexChiffres = "[0-9]+";

regexCaracteresSpeciaux = "[^a-zA-Z0-9]+";


if (
    Regex.IsMatch(motDePasse, regexMinuscules) &&
    Regex.IsMatch(motDePasse, regexMajuscules) &&
    Regex.IsMatch(motDePasse, regexChiffres) &&
    (Regex.IsMatch(motDePasse, regexCaracteresSpeciaux) && motDePasse.Length >= 12 || motDePasse.Length >= 20)

   )
{
    Console.WriteLine("Mot de passe OK");
}
else
{
    Console.WriteLine("Mot de passe trop faible !");
}