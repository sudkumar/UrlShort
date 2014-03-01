myGit
=====
          I this git repository, I have to make a web application using php on my local computer server using XAMPP. This
application does some what the same work as url shorter websites does. It takes input long url as a  parameter and returns
the shorted url on the screen. You copy that url and  paste it into the address. It will automatically re-direct you to 
same page that you wish to open from long url.
          I have used PHP, MySQL for most of the part and also little bit HTML, CSS to look preety and also javascript as
one place I need to store data and put it back to document.inerHTML. I started working on this app after having a look at
other url shortening sites and takin some help from Wiki as these websites probably should work. After 3-4 wrong ideas, 
wrong idea it the sense that I din't found any implementation way to work on them. And after this I got an idea about this, 
which is as following.

-> Take the input url from the user and save it as url.
-> Make it's hash. In PHP we have a function "md5()" which takes a argument and create a hash of 32
    (in my case) latter string which is a combination of 0-9 and a-z.
-> After that I take a portion of that hash and store it as id.      
-> After that connecting to my local server I put these two datas in a table in two raw having id as primary key.
-> Send back the url appending to our server string and also make a php file  with the id name. 
-> As the user will copy and paste the shortened url in address bar, our newly created will be open. So what we should do
   now is redirect the user to the url that was stored for that particular id. So we use our data-base again and redirect
   user that specific location.
