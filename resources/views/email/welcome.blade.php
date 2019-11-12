<!DOCTYPE html>
    <html lang="en-US">
    	<head>
    		<title>Welcome | NDDC Tracker</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
    		<style type="text/css">
    			* {
    				box-sizing: border-box;
    				padding: 0;
    				margin: 0;
    			}
    			body {
    				background: white;
    				color: black !important;
    			}
    			.verifycode {
    				color: purple;
    				background: white;
    				border: 1px solid purple;
    				text-align: center;
    				padding: 10px 50px 10px 50px;
    				width: 50%;
    				margin: auto;
    				font-size: 20px;
    				font-weight: bold;
    			}
    			.welcome{
    				font-weight: bold;
    				text-align: center;
                    color: purple !important;
    			}
    			.note{
    				font-weight: bold;
    				text-align: center;
                    color: black !important;
    			}
				.team{
                    font-weight: normal;
                    font-size: 15px;
                    text-align: center;
                    color: grey !important;
                }

    		</style>
    	</head>
    	<body>
    		<div>
    			
    		</div>
    		<h2 class="welcome">Welcome To NDDC Tracker</h2>
    		<div>
    			 <h4>Hello {{ $user->email}}</h4>
    		</div>
    		
    		<div>
    			 <p class="note">Thank you for creating an account, use this verification token to confirm account</p>
    			 <p class="verifycode">{{ $user->verifycode}}</p>
    		</div>
			<div>
                 <p class="team">if this mail is not authourize by you please kindly discard</p>
                 <p class="team" style="font-style: italic;">NDDC Tracker Team</p>
            </div>
    	</body>
    </html>