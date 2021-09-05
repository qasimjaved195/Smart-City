$("#notify-button").click(function(){
    Push.create("Hello world!",{
        body: "This is example of Push.js Tutorial",
        icon: '/Logo_small.png',
        timeout: 2000,
        onClick: function () {
            window.focus();
            this.close();
        }
    });
