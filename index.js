
var Cleverbot = require("cleverbot.io");

// .slice(2) removes the first 2 arguments, which are the nodejs executable path, and the filename
let input = process.argv.slice(2).join(' ');

let bot = new Cleverbot("XpmhthFt8IiPZGhf", "kR08YPAJ46ivX0dqbEcdJnou9WfnyXNH");
bot.setNick("Sahabat_Susu");

var nama;

bot.create(function (err, session) {

});

bot.ask(input, function (err, response) {
        console.log(response);
});	