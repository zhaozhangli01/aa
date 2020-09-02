const http=require('http');
const app=http.createServer();
app.listen(8080);
app.on('request',(req,res)=>{
	res.write('hello world');
	res.end();
})



