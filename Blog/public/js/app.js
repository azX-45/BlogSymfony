const APIKEY = 'dc60342e538e65d00dd4c1724f343d54';

//Appel a l'API openWeather
let apiCall = function (city) {
  let url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${APIKEY}&units=metric&lang=fr`;
  fetch(url)
    .then((response) =>
      response.json().then((data) => {
        console.log(data);
        document.querySelector('#city').innerHTML = data.name;
        document.querySelector('#temp').innerHTML =
          "<i class='fas fa-thermometer-half'></i>" + data.main.temp + '°';
        document.querySelector('#humidity').innerHTML =
          "<i class='fas fa-tint'></i>" + data.main.humidity + '%';
        document.querySelector('#wind').innerHTML =
          "<i class='fas fa-wind'></i>" + data.wind.speed + 'km/h';
      })
    )
    .catch((err) => console.log('Erreur : ' + err));
};
navigator.geolocation.getCurrentPosition((position) =>{
  console.log(position.coords.latitude, position.coords.longitude);
});
//Ecouteur d'evenement formulaire
document.querySelector('form').addEventListener('submit', function (e) {
  e.preventDefault();
  let ville = document.querySelector('#inputCity').value;

  apiCall(ville);
});

//Appel par defaut
apiCall('Orléans');