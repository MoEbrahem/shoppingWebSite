const http = require("http");
const fs = require("fs");

http
    .createServer((req, res) => {
        if (req.method == "POST") {
            let requestData = "";

            req.on("data", (data) => {
                requestData += data;
            });
            req.on("end", () => {
                const user = JSON.parse(requestData);
                if (req.url === "/register") {
                    fs.appendFileSync(
                        "./users.txt",
                        "\r\n" + user.username + ":" + user.password
                    );
                    res.writeHead(200);
                    res.write("User registered successfully");
                    res.end();
                } else if (req.url === "/login") {
                    let found = false;
                    fs.readFile("./users.txt", (err, data) => {
                        data
                            .toString()
                            .split("\r\n")
                            .forEach((u) => {
                                const [username, password] = u.split(":");
                                if (user.username === username && user.password === password) {
                                    found = true;
                                    res.writeHead(200);
                                    res.write("Logged in successfully");
                                    res.end();
                                }
                            });
                        if (!found) {
                            res.writeHead(422);
                            res.write("Wrong username or password");
                            res.end();
                        }
                    });
                }
            });
        }

        res.setHeader("Access-Control-Allow-Origin", "*");
        res.setHeader("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE");
        res.setHeader("Access-Control-Allow-Headers", "Content-Type");
        // headers for network
    })
    .listen(3000);
console.log("http://localhost:5500/")