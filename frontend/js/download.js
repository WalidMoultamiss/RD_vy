let id = location.search
params = new URLSearchParams(id)

setTimeout(() => {
    let ticket = document.querySelector("#tm")
    let a = ReserverUser.all.filter((elm) => {
        if (+elm.id === +params.get("id")) {
            return elm
        }
    })
    console.log(a);
    Passengers.getPassengersByRes(params.get("id")).then((result) => {
        console.log(result);

    })
    html2pdf().set({
        pagebreak: { mode: 'avoid-all', before: '#breakPage' }
      });
    
    html2pdf().from(ticket).save()
    setTimeout(() => {
        window.close()
    }, 1000);

}, 100);







// 