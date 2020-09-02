const express=require('express');
const app=express();
app.listen(8080);
app.get('/aa',(req,res)=>{
	res.sendFile(__dirname+'/aa.html');
});
app.get('/detail',(req,res)=>{
	res.send('北京欢迎你'+req.query.lid);
});

