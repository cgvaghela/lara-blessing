#BlessingScript
BlessingScript is a prayer request application that allows users to submit requests, or pray for existing requests, as well as allowing site administrators to manage prayer requests. All requests can be moderated from the admin section and can be flagged by members as inappropriate requests. There is a IP ban system in place as well to discourage improper usage.
Every time a request is prayed for, and the user clicks the “I Prayed For You” button.

##Frontend Features
1) Home Page with Dynamic Slider:
	->You can change the slider image from admin panel manage Slider section
2) Add new Prayer Request page:
	->By this page you can add your prayer request that is display in admin Panel of section ‘active Requests List’.


##Pray for someone:
1) This page is displayed request that is inserted by user with their particuler date .
2) From this page you can see the detail information of Prayer and request of prayer by click veiw details.
3) In View page two options are their –

#First One :  I PRAYED FOR YOU
	--From that other persone as well as you can lift up your request to that Requester. also you will receive an email once a day with you know how many times your prayer request has been lifted up.

##Second one: Abuse Request
	--If persone content is not appropriate, user can  click that button and reported to admin in Flagged Prayer Requests that user has no appropriate content  .
	--From this page you can submit a parise report after click submit praise report button.After Submit their Praise report user’s channel is completed and now it sent back to the Closed Request List in Admin Section . 

##Praise Reports page:
	->This page displayed the praise report with prayer request and report .


#Admin Panel Backend Features

##Login
Secure admin with login success.

##Dashboard
Dashboad with quick overview of all the modules

##Active request List:
->Listing of all active request
->Green button:For Edit Prayer request
	From that you can edit prayer request details	
->Red button : for remove request
	After clicking that button that request is permantly deleted.
->Sky blue button: for close request
	After clicking that button that request is sent back to the closed Request List .
->Brush button: for banned request
	After clicking that button that request is sent back to the banned Requset List.

##Flagged  Request Page:
->Listing falgged Request , which is abused by user from user side
->Red Button: For Remove rquest 
	If Admin realise that Requester is wrong than click Red button for Remove Request .After clicking that button Remove that request from active request List.
->Sky blue button: For Clear Flag 
	If Admin realise that Requester is not wrong than click Sky blue button for clear flag  .After clicking that button only clear flag report.
->Green button: For Banned Requester
	If Admin realise that Requester is wrong and also admin want to banned requester, click that button and banned that requestor .
	After clicking that button requester is sent back to the banned List and that bannded requester does not send New prayer request from that banned Ip.

##Closed Requests  List page:
->List close prayer Request 
->Red button: for delete request 
	After clicking that button requestor permenlty delete .
->Sky blue button :For reopen Request
	After clicking that button request is reopen and display in active request List.

##Praise Report 
->Display Praise Report that was displayed by user from user side .
->Green Button: use for hide that report
	Using that button admin can hide praise Report,which is display in user side.

##Banned IP page:
->Display banned Report list which is banned Ip  by admin from Active request List and flagged request List section.
->Red Button : use for unbanned request.
	From that admin can unbanned Ip .After clicking that button , user can add new request with this unbanned Ip and also use all functionality from user side.

##Change credentials:
->Edit password with use their old password and username.

##Manage Slider:
Having two option: 
1) Slider add page:
	From that admin can add new slider with title and link.
2) Slider Manage : 
	Display slider list and Manage also.
	Green Button :Use for Edit slider 
	Red Button: Use for delete Slider.
	Active and deactive button: chage the status like active and deactive .

##Logout page:
For closing your session.
