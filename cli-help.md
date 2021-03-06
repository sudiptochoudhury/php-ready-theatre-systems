# RTS-API Command Line Tool

USAGE:

```   rts <OPTIONS> <COMMAND> <COMMAND OPTIONS>```


### OPTIONS

> Make sure to pass these options before the command  
 
```
   -c <rts.json>,        RTS Configuration file - default: rts.json       
   --config <rts.json>                                                    

   -l                    Log file path                                    
   <command-name.log>,                                                    
   --log                                                                  
   <command-name.log>                                                     

   -e <dev|prod>, --env  Environment - dev or production                  
   <dev|prod>                                                             

   -s, --simulate        Simulate                                         

   -q, --quiet           Quiet Mode                                       

   -d, --skip-defaults   Skip Configuration Defaults                      

   -v, --version         Show Version                                     

   -h, --help            Display this help screen and exit immeadiately.  

   --no-colors           Do not use any colors in output. Useful when     
                         piping output to other tools or files.           

   --loglevel <level>    Minimum level of messages to display. Default is 
                         debug. Valid levels are: debug, info, notice,    
                         success, warning, error, critical, alert,        
                         emergency.                                       

```
### COMMANDS

   > Pass the command as first parameter after the above options. Options for 
   each command, as outlined below, need to be passed after the command      



##### Get all Performance Schedule
                                         
                                                                          
`getShowTimes <OPTIONS>`

     --ShowAvalTickets                                                    

     --ShowSales                                                          

     --ShowSaleLinks                                                      

     -m, --man            Show help on this command                       


##### Get Gift Card / Loyalty Card Information                             

`getGiftCardInformation <OPTIONS>`

     --GiftCards                                                          
     <[number1, number2,                                                  
     ...]>                                                                

     -m, --man            Show help on this command                       


`   buyGiftCard <OPTIONS>`

     New Gift Card Purchase                                               
                                                                          

     --Amount <amount>                                                    

     --Type <type>                                                        

     --TransactionId                                                      
     <transaction-id>                                                     

     --ProcessCompletePos                                                 
     tData                                                                
     <process-complete-po                                                 
     st-data>                                                             

     --GiftNumber                                                         
     <gift-number>                                                        

     --Number <number>                                                    

     --Expiration                                                         
     <expiration>                                                         

     --AvsStreet                                                          
     <avs-street>                                                         

     --AvsPostal                                                          
     <avs-postal>                                                         

     --CID <c-i-d>                                                        

     --NameOnCard                                                         
     <name-on-card>                                                       

     --ChargeAmount                                                       
     <charge-amount>                                                      

     -m, --man            Show help on this command                       


##### Add Money to Existing Gift Card 
   
`refillGiftCard <OPTIONS>`

     --GiftCard                                                           
     <gift-card>                                                          

     --Amount <amount>                                                    

     --Type <type>                                                        

     --TransactionId                                                      
     <transaction-id>                                                     

     --ProcessCompletePos                                                 
     tData                                                                
     <process-complete-po                                                 
     st-data>                                                             

     --GiftNumber                                                         
     <gift-number>                                                        

     --Number <number>                                                    

     --Expiration                                                         
     <expiration>                                                         

     --AvsStreet                                                          
     <avs-street>                                                         

     --AvsPostal                                                          
     <avs-postal>                                                         

     --CID <c-i-d>                                                        

     --NameOnCard                                                         
     <name-on-card>                                                       

     --ChargeAmount                                                       
     <charge-amount>                                                      

     -m, --man            Show help on this command                       


##### Registering a Loyalty Card                                           

`registerLoyaltyCard <OPTIONS>`

     --CardNumber                                                         
     <card-number>                                                        

     --FirstName                                                          
     <first-name>                                                         

     --LastName                                                           
     <last-name>                                                          

     --Address1                                                           
     <address1>                                                           

     --Address2                                                           
     <address2>                                                           

     --City <city>                                                        

     --State <state>                                                      

     --Postal <postal>                                                    

     --RegisteredID                                                       
     <registered-i-d>                                                     

     --Email <email>                                                      

     --DOB <d-o-b>                                                        

     --DoNotEmail                                                         
     <do-not-email>                                                       

     -m, --man            Show help on this command                       


##### Check if a all tickets for a performance has been sold out

`checkIfSoldOut <OPTIONS>`

     --PerformanceID                                                      
     <performance-i-d>                                                    

     -m, --man            Show help on this command                       


##### Has redeemed?

`   hasRedeemed <OPTIONS>`

     --PickupNumber                                                       
     <pickup-number>                                                      

     -m, --man            Show help on this command                       

##### Verify transaction 

   `verifyTransaction <OPTIONS>`

     --ThirdPartyID                                                       
     <third-party-i-d>                                                    

     --TransactionDateTim                                                 
     eUTC                                                                 
     <transaction-date-ti                                                 
     me-u-t-c>                                                            

     -m, --man            Show help on this command                       


##### Refund 


   `refund <OPTIONS>`

     --TicketFee                                                          
     <ticket-fee>                                                         

     --TransactionFee                                                     
     <transaction-fee>                                                    

     --Adjust <adjust>                                                    

     --PickupNumber                                                       
     <pickup-number>                                                      

     -m, --man            Show help on this command                       


##### Reverse 


   `reverse <OPTIONS>`

     --TicketFee                                                          
     <ticket-fee>                                                         

     --TransactionFee                                                     
     <transaction-fee>                                                    

     --Adjust <adjust>                                                    

     --ThirdPartyID                                                       
     <third-party-i-d>                                                    

     -m, --man            Show help on this command                       


##### Pay using Hosted Checkout 


   `payUsingHostedCheckout <OPTIONS>`

     --ChargeAmount                                                       
     <charge-amount>                                                      

     --ProcessCompleteUrl                                                 
     <process-complete-ur                                                 
     l>                                                                   

     --ReturnUrl                                                          
     <return-url>                                                         

     -m, --man            Show help on this command                       


##### Buy Ticket 


   `buyTicket <OPTIONS>`

     --PerformanceID                                                      
     <performance-i-d>                                                    

     --Title <title>                                                      

     --Auditorium                                                         
     <auditorium>                                                         

     --MTPerformanceID                                                    
     <m-t-performance-i-d                                                 
     >                                                                    

     --MtFilmCode                                                         
     <mt-film-code>                                                       

     --ShowTime                                                           
     <show-time>                                                          

     --Amount <amount>                                                    

     --TypeCode                                                           
     <type-code>                                                          

     --TicketFee                                                          
     <ticket-fee>                                                         

     --TransactionFee                                                     
     <transaction-fee>                                                    

     --Adjust <adjust>                                                    

     --Type <type>                                                        

     --TransactionId                                                      
     <transaction-id>                                                     

     --ProcessCompletePos                                                 
     tData                                                                
     <process-complete-po                                                 
     st-data>                                                             

     --GiftNumber                                                         
     <gift-number>                                                        

     --Number <number>                                                    

     --Expiration                                                         
     <expiration>                                                         

     --AvsStreet                                                          
     <avs-street>                                                         

     --AvsPostal                                                          
     <avs-postal>                                                         

     --CID <c-i-d>                                                        

     --NameOnCard                                                         
     <name-on-card>                                                       

     --ChargeAmount                                                       
     <charge-amount>                                                      

     --CardNumber                                                         
     <card-number>                                                        

     --ThirdPartyID                                                       
     <third-party-i-d>                                                    

     --Email <email>                                                      

     -m, --man            Show help on this command                       


##### Get all Seat layouts (global) 


   `getAllSeatLayouts <OPTIONS>`

     Get all Seat Layouts                                                 
                                                                          

     -m, --man            Show help on this command                       


##### Get Seat Layout for Performance
   
   `getSeatLayout <OPTIONS>`

                                   
                                                                          

     --PerformanceID                                                      
     <performance-id>                                                     

     -m, --man            Show help on this command                       

##### Verify seat

>This call allows for you to verify the point-of-sale system will     
     allow the sale of the seats picked. This is in order to stop customer
     from leaving too many single seats across the auditorium.            
      

   `checkPickedSeat <OPTIONS>`

                                                                          

     --PerformanceID                                                      
     <performance-id>                                                     

     --Row <row>                                                          

     --Col <col>                                                          

     --RowIndex                                                           
     <row-index>                                                          

     --ColIndex                                                           
     <col-index>                                                          

     --Section <section>                                                  

     -m, --man            Show help on this command                       


##### Get Seat Layout for Performance      

   `getSeatChart <OPTIONS>`

                                
                                                                          

     --PerformanceID                                                      
     <performance-id>                                                     

     --MtPerformanceID                                                    
     <mt-performance-id>                                                  

     --MtFilmCode                                                         
     <mt-film-code>                                                       

     --ShowTime                                                           
     <show-time>                                                          

     -m, --man            Show help on this command                       


##### Hold Seats

   `holdSeats <OPTIONS>`

                                                                
                                                                          

     --PerformanceID                                                      
     <performance-id>                                                     

     --Row <row>                                                          

     --Col <col>                                                          

     --RowIndex                                                           
     <row-index>                                                          

     --ColIndex                                                           
     <col-index>                                                          

     --Section <section>                                                  

     -m, --man            Show help on this command                       


##### Release already hold seats       

   `releaseSeats <OPTIONS>`

                                         
                                                                          

     --TransactionID                                                      
     <transaction-id>                                                     

     -m, --man            Show help on this command                       


##### Check Sales Tax on Concession Sales  

   `checkSalesTaxOnConcessionSales <OPTIONS>`

                                     
                                                                          

     --ItemName                                                           
     <item-name>                                                          

     --Amount <amount>                                                    

     -m, --man            Show help on this command                       


##### Purchase Concession Sales items       

   `buyConcessionItems <OPTIONS>`
                               
                                                                          

     --ItemName                                                           
     <item-name>                                                          

     --Amount <amount>                                                    

     --TicketFee                                                          
     <ticket-fee>                                                         

     --TransactionFee                                                     
     <transaction-fee>                                                    

     --Adjust <adjust>                                                    

     --Type <type>                                                        

     --TransactionId                                                      
     <transaction-id>                                                     

     --ProcessCompletePos                                                 
     tData                                                                
     <process-complete-po                                                 
     st-data>                                                             

     --GiftNumber                                                         
     <gift-number>                                                        

     --Number <number>                                                    

     --Expiration                                                         
     <expiration>                                                         

     --AvsStreet                                                          
     <avs-street>                                                         

     --AvsPostal                                                          
     <avs-postal>                                                         

     --CID <c-id>                                                         

     --NameOnCard                                                         
     <name-on-card>                                                       

     --ChargeAmount                                                       
     <charge-amount>                                                      

     -m, --man            Show help on this command                       

