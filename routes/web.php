<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::name('Sancofa.')->group(function(){

		 Route::get('/','Sancofa\Auth\LoginController@login')->name('Index');
		 Route::post('/Sancofa_Login','Sancofa\Auth\LoginController@authenticate')->name('LogIn');
		 Route::get('/Forgot_Password','Sancofa\Members\ForgotPasswordController@index')->name('ForgotPassword');
		 Route::post('/Check_Forgot_Password','Sancofa\Members\ForgotPasswordController@checkForgotPassword')->name('CheckForgotPassword');

		Route::middleware(['SancofaAuth'])->group(function(){

			Route::prefix('Others')->name('Others.')->group(function(){

				 Route::middleware('admin')->group(function(){

					 Route::get('/','Sancofa\Others\OthersController@index')->name('Index');
	                 
	                 Route::get('/Create_Monthly_Payment','Sancofa\Others\OthersController@createMonthlyPaymentIndex')->name('CreateMonthlyPayment');
	                 Route::post('/Creating_Monthly_Payment','Sancofa\Others\OthersController@monthlyPaymentCreating')->name('MonthlyPaymentCreating');
	                 Route::get('/Close_Monthly_Payment/{year}','Sancofa\Others\OthersController@closeMonthlyPayment')->name('CloseMonthlyPayment');


				 });
                 Route::get('/Monthly_Payment','Sancofa\Others\OthersController@monthlyPaymentIndex')->name('MonthlyPayment');
                 Route::get('/Monthly_Payment/{year}','Sancofa\Others\OthersController@monthlyPaymentYear')->name('MonthlyPaymentYear');
                 Route::get('/AddMembers_To_Payment/{year}','Sancofa\Others\OthersController@addMembersToPaymentView')->name('AddMembersToPayment');
                 Route::post('/AddMembers_To_Payment/{year}','Sancofa\Others\OthersController@memberAddingToMonthlyPayment')->name('MemberAddingToMonthlyPayment');
                 Route::get('/Paiding_Monthly_Payment/{id}/{month}/{year}','Sancofa\Others\OthersController@paidingMonthlyPayment')->name('PaidingMonthlyPayment');
                 Route::get('/Search_In_Monthly_Payment/{year}','Sancofa\Others\OthersController@searchInMonthlyPayment')->name('SearchInMonthlyPayment');

			});

			   Route::get('/About_Sancofa',function(){

                   return view('sancofa.about');

			   })->name('About');

		 	   Route::middleware('block')->group(function(){



			 	 	Route::get('/Sancofa_Home', 'Sancofa\HomeController@index')->name('Home');
		            Route::get('/Sancofa_Logout','Sancofa\HomeController@logout')->name('LogOut');

		      Route::prefix('Members')->name('Members.')->group(function(){

		              Route::get('/add_new_member','Sancofa\Members\MembersController@index')->name('Add');
			            Route::post('/add_new_member','Sancofa\Members\MembersController@register')->name('Added');
			            Route::get('/All_Members','Sancofa\Members\MembersController@allMembers')->name('AllMembers');
									Route::get('/Search_BY_Sancofa_Id','Sancofa\Members\MembersController@searchBySancofaID')->name('SearchBySancofaID');
			            Route::get('/adding_address/{id}',function($id){

			            	return view('sancofa.member.address',['id' => $id]);

			            })->name('AddAddress');


                Route::middleware('admin')->group(function(){

	                  Route::get('/Edit_Members_Data/{id}','Sancofa\Members\MembersController@updateView')->name('UpdateView');
				            Route::post('/Update_Members_Data/{id}','Sancofa\Members\MembersController@updateMember')->name('Update');

				            Route::get('/Active_Member_Activity/{id}','Sancofa\Members\ActivityController@index')->name('Activity');
				            Route::get('/Detail_Recent_Activity/{id}/{log}','Sancofa\Members\ActivityController@detailRecentActiviyty')->name('DetailRecentActiviyty');
				            Route::get('/Detail_Recent_Activity/{id}','Sancofa\Members\ActivityController@detailOnUpdates')->name('DetailOnUpdates');
				            Route::get('/Detail_About_Member','Sancofa\Members\MembersController@detailAboutMember')->name('DetailAboutMember');

				            Route::prefix('All_Activities')->name('AllActivities.')->group(function(){

                                Route::get('/{id}','Sancofa\Members\ActivityController@allActivitiesIndex')->name('index');
                                Route::get('/{id}/{year}','Sancofa\Members\ActivityController@AllActivitiesYear')->name('Year');
                                Route::get('/{id}/{year}/{month}','Sancofa\Members\ActivityController@AllActivitiesMonth')->name('Month');
                                Route::get('/{id}/{year}/{month}/{log_name}','Sancofa\Members\ActivityController@detailInMonth')->name('DetailInMonth');
				            });



              });


			            Route::post('/adding_address/{id}','Sancofa\Members\MembersController@updateOrCreateAddress')->name('SubmitAddress');
			            Route::get('/update_photo_status/{id}','Sancofa\Members\MembersController@updatePhotoStatus')->name('UpdatePhotoStatus');
			            Route::get('/update_payment_status/{id}','Sancofa\Members\MembersController@updatePaymentStatus')->name('UpdatePaymentStatus');
			            Route::get('/search','Sancofa\Members\MembersController@searchMembers')->name('Search');
			            Route::get("/Request::input('order')",'Sancofa\Members\MembersController@orderBy')->name('Order');
			            Route::get('/Block_Member/{id}','Sancofa\Members\MembersController@blockUser')->name('Block')->middleware('admin');
			            Route::get('/UnBlock_Member/{id}','Sancofa\Members\MembersController@unBlockUser')->name('UnBlock')->middleware('admin');
			            Route::get('/Borrowed_History/{id}','Sancofa\Members\MembersController@BorrowedHistory')->name('BorrowedHistory');


		 	    });


		 	    Route::prefix('Books')->name('Books.')->group(function(){

		 	       Route::middleware('admin')->group(function(){

		 	       	   Route::get('/Book_Rank_Year','Sancofa\Books\RankController@index')->name('RankOfYear');
		 	       	   Route::get('/Book_Rank/{year}','Sancofa\Books\RankController@bookRank')->name('BookRank');

		 	       	   Route::prefix('Count_Books')->name('CountBooks.')->group(function(){

                            Route::post('/Add/{id}','Sancofa\Books\CountBookController@countBooks')->name('Count');
                            Route::get('/Add','Sancofa\Books\CountBookController@create')->name('Create')->middleware('count');
			            	Route::get('/List_Of_Countings','Sancofa\Books\CountBookController@index')->name('Index');
			            	Route::get('/{id}','Sancofa\Books\CountBookController@show_count_books_page')->name('CountBooksPage');
			            	Route::get('/Finish/{id}','Sancofa\Books\CountBookController@finishCountingBoks')->name('Finish');
				            Route::get('/{id}/Counted_Books','Sancofa\Books\CountBookController@countedBooks')->name('ListOfCountedBook');
				            Route::get('{id}/List_Of_Un_Counted_Books/','Sancofa\Books\CountBookController@unCountedBooks')->name('ListOfUnCountedBooks');
				            Route::get('/Make_Lost/{id}/{count}','Sancofa\Books\CountBookController@makeLost')->name('MakeLost');

				            });


		 	       });

                   Route::get('/Search_BY_Accession','Sancofa\Books\BookBorrowingController@searchByAccessionKey')->name('SearchByAccessionKey');
                   Route::get('/Add_Books','Sancofa\Books\BooksController@index')->name('Add');
                   Route::post('/Add_Books','Sancofa\Books\BooksController@register')->name('Added');
                   Route::get('/All_Registered_Books','Sancofa\Books\BooksController@allBooks')->name('AllBooks');
                   Route::get('/All_Book_Status','Sancofa\Books\BooksController@allBookStatus')->name('BookStatus');
                   Route::middleware('admin')->group(function(){

                    Route::get('/Edit_Books/{id}','Sancofa\Books\BooksController@editBook')->name('EditBook');
                    Route::post('/Update_Book_Info/{id}','Sancofa\Books\BooksController@update')->name('Update');

                   });



                   Route::get('/to_check_member','Sancofa\Books\BookBorrowingController@index')->name('Borrowing');

                   Route::get('/Checking_Member','Sancofa\Books\BookBorrowingController@check')->name('CheckBorrowing');

                   Route::get('/Borrowing_Books/{reciever_id}','Sancofa\Books\BookBorrowingController@giveBook')->name('Borrowed');

                   Route::get('/Borrowed_book/{id}','Sancofa\Books\BookBorrowingController@borrowed')->name('EndBorrow');

                   Route::get('/All_Borrowed_Books','Sancofa\Books\BookBorrowingController@allBorrowedBooks')->name('AllBorrowedBooks');

                   Route::get('/Extending_Borrowed_Books/{id}','Sancofa\Books\BookBorrowingController@extendBorrowedBook')->name('Extend');


                   Route::get('Return_Books_With_PunishMent/{id}','Sancofa\Books\BookReturningController@withPunishMent')->name('ReturnWithPunishMent');
                   Route::get('/Return_Books_With_Out_Punishment/{id}','Sancofa\Books\BookReturningController@withOutPunishMent')->name('ReturnBookWithOutPunishment');
                   Route::get('/Return_Books_With_No_Punishment/{id}','Sancofa\Books\BookReturningController@noPunishment')->name('ReturnBookWithNoPunishment');
                   Route::get('/Search','Sancofa\Books\BooksController@search')->name('Search');
                   Route::get('/Find_By_Accession','Sancofa\Books\BooksController@findByAccession')->name('FindByAccession');
                   Route::get('/Make_Lost/{id}','Sancofa\Books\BooksController@makeLost')->name('MalkeLost')->middleware('admin');
                   Route::get("/Request::input('order')",'Sancofa\Books\BooksController@orderBy')->name('Order');

                   Route::get('/Reserving_Books/{id}',function($id){

                   	  return view('sancofa.books.reservebookinput',['id'=>$id]);

                   })->name('ReservingBooks');
                   Route::post('/Reserving_Books/{id}','Sancofa\Books\BookReservingController@reserve')->name('ReservedBook');
                   Route::get('/Reserved_Books','Sancofa\Books\BookReservingController@allReservedBooks')->name('AllReservedBooks');
                   Route::get('/Book_Reseve_Notification/{id}','Sancofa\Books\BookReservingController@notify')->name('ReserveNotify');


		 	    });

		 	    Route::name('Punishment.')->prefix('Punishment')->group(function(){

		 	    	Route::get('/list_of_punished_member','Sancofa\Books\PunishMentController@show')->name('Show');
		 	    	Route::get('/paying_punishment/{b_id}/{p_id}','Sancofa\Books\PunishMentController@pay')->name('Pay');

		 	    });

		 	    Route::name('Department.')->prefix('Department')->group(function(){

                     Route::get('/list_of_registered_department','Sancofa\Department\DepartmentController@index')->name('RegisteredDepartment');
                     Route::get('/Add_New_Department',function(){

                     	 return view('sancofa.department.add');

                     })->name('Add');
                     Route::post('/Add_New_Department','Sancofa\Department\DepartmentController@add')->name('Added');

		 	    });

		 	    Route::name('Borrower.')->prefix('Borrower')->group(function(){

		 	    	Route::get('/','Sancofa\Borrower\SearchController@search')->name('Search');
		 	    });

		 	    Route::name('ActiveMembers.')->prefix('Active_Members')->middleware(['admin','block'])->group(function(){

		 	    	Route::get('/List_Of_Active_Members','Sancofa\Members\MembersController@allActiveMembers')->name('ListOfActiveMembers');
		 	    	Route::get('/Add_Active_Member',function(){

		 	    		return view('sancofa.member.checkforactive');

		 	    	})->name('Add');


		 	    	Route::get('/check_for_active','Sancofa\Members\MembersController@check')->name('Find');
		 	    	Route::post('activate/{id}','Sancofa\Members\MembersController@activate')->name('Active');
		 	    	Route::get('/De_Active/{id}','Sancofa\Members\MembersController@deActivate')->name('DeActive');
		 	    	Route::get('/Change_Password/{id}',function($id){

                       return view('sancofa.member.changepasswordforactive',['id' => $id]);

		 	    	})->name('ChangePassword');

		 	    	Route::post('/Change_Password/{id}','Sancofa\Members\MembersController@changePasswordForActive')->name('PasswordChanged');
		 	    	Route::get('Activity/{id}','Sancofa\MemberActivity@allActivity')->name('Activity');
		 	    });
                Route::middleware(['admin','block'])->group(function(){

	                Route::get('/sancofa_reader_rank','Sancofa\Members\RankController@rank')->name('RankOfReaders');
			 	    Route::get('/list_of_readers_rank/{year}',
			 	    	'Sancofa\Members\RankController@listOfRankAllOver')->name('ListOfRank');
			 	    Route::get('/sancofa_female_reader_rank/{year}','Sancofa\Members\RankController@listOfRankFemale')->name('FemaleRank');
			 	    Route::get("'/rank_of'.Request->department/{year}",'Sancofa\Members\RankController@rankOfDepartment')->name('RankOfDepartment');


                });


		 	    Route::name('Profile.')->prefix('Profile')->middleware('block')->group(function(){

	                   Route::get('/','Sancofa\Profile\ProfileController@showProfile')->name('Show');
	                   Route::get('/Change_Password','Sancofa\Profile\ProfileController@showProfile')->name('ChangePassword');
	                   Route::post('/Change_Password','Sancofa\Profile\ProfileController@changePassword')->name('PasswordChanged');
	                   Route::get('/Change_Profile_Picture','Sancofa\Profile\ProfileController@showProfile')->name('ChangeProfilePicture');
	                   Route::post('/Upload_Profile_Picture','Sancofa\Profile\ProfileController@uploadProfilePicture')->name('UploadProfilePicture');
	                   Route::get('/Fill_Password_Question','Sancofa\Members\ForgotPasswordController@index')->name('FillPasswordQuestion');
	                   Route::post('Fill_Password_Question','Sancofa\Members\ForgotPasswordController@saveAnswers')->name('SaveForgotPasswordQuestion');
	                   Route::get('/Update_Password_Question','Sancofa\Members\ForgotPasswordController@index')->name('UpdatePasswordQuestion');
	                   Route::get('/Transfer_Admin_Account',function(){

	                   	   return view('sancofa.member.transfer');
	                   })->name('TransferAdminAccount')->middleware('admin');

	                   Route::post('/Transfer_Admin_Account','Sancofa\Members\AdminTransferController@transfer')->name('AdminTransferring')->middleware('admin');


		 	    });


		 	    Route::name('Setting.')->prefix('Setting')->middleware(['admin','block'])->group(function(){



		 	    	Route::get('/',function(){

		 	    		return view('sancofa.setting.index');
		 	    	})->name('Home');
		 	    	Route::get('/Add_Home_Profile',function(){

		 	    		return view('sancofa.setting.addprofile');

		 	    	})->name('AddProfile');

		 	    	Route::post('/Add_Home_Profile',
		 	    		'Sancofa\Setting\SettingController@addNewProfile')->name('ChangeProfile');
		 	    	Route::get('/Old_Home_Profile','Sancofa\Setting\SettingController@oldHomeProfile')->name('OldHomeProfile');
		 	    	Route::get('/Repost/{id}','Sancofa\Setting\SettingController@rePost')->name('Repost');
		 	    	Route::get('/Charge','Sancofa\Setting\SettingController@charge')->name('Charge');
		 	    	Route::get('/Change_Payment/{id}',function($id){

		 	    		return view('sancofa.setting.changecharge',['id' => $id]);

		 	    	})->name('ChangePayment');
		 	    	Route::get('/Changed_Payment/{id}','Sancofa\Setting\SettingController@changePayment')->name('ChangedPayment');
		 	    	Route::get('/Add_Book_Catagory',function(){

		 	    		return view('sancofa.setting.addcatagory');
		 	    	})->name('AddCatagory');

		 	    	Route::post('/Add_Book_Catagory','Sancofa\Setting\SettingController@addCatagory')->name('CatagoryAdded');
		 	    	Route::get('/All_Book_Catagory','Sancofa\Setting\SettingController@allCatagory')->name('AllCatagory');
		 	    	Route::get('/Delete_Book_Catagory/{id}','Sancofa\Setting\SettingController@deleteCatagory')->name('DeleteCatagory');
		 	    	Route::get('/Show_Rename_Index/{id}','Sancofa\Setting\SettingController@showRenameIndex')->name('ShowRenameIndex');
		 	    	Route::post('/Rename_Catagory/{id}','Sancofa\Setting\SettingController@renameCatagory')->name('RenameCatagory');
		 	    	Route::get('/import',function(){

		 	    		return view('sancofa.setting.import');

		 	    	})->name('Import');

		 	    	Route::get('/Export',function(){

		 	    		return view('sancofa.setting.export');

		 	    	})->name('Export');
		 	    	Route::get('/Export_Books',function(){

		 	    		return view('sancofa.setting.bookExport');
		 	    	})->name('BookExportLink');
		 	    	Route::get('/DownloadAll_Books','Sancofa\Setting\BookExportController@allBooks')->name('DownloadAllBooks');


		 	    	Route::get('/Export_Members',function(){

                        return view('sancofa.setting.memberexport');

		 	    	})->name('MemberExportLink');
		 	    	Route::get('/Download_AllMembers','Sancofa\Setting\MemberExportController@allMember')->name('DownloadAllMembers');


		 	    	Route::get('/Import_Book',function(){

		 	    		return view('sancofa.setting.importbook');

		 	    	})->name('ImportBooks');

		 	    	Route::get('/Import_Members',function(){

		 	    		return view('sancofa.setting.importmembers');

		 	    	})->name('ImportMembers');

		 	    	Route::post('/Importing_Members','Sancofa\Setting\MemberImportController@import')->name('MemberImporting');
		 	    	Route::post('/Importing_Books','Sancofa\Setting\BookImportController@import')->name('BookImporting');
		 	    	Route::get('/Blocked_Members','Sancofa\Members\MembersController@blockedMembers')->name('BlockedMembers');

		 	    	Route::get('/General_Members_Report','Sancofa\Setting\Report\GeneralReport@generalMemberReport')->name('GeneralMembersReport');

		 	    	Route::get('/Daily_Report','Sancofa\Setting\Report\GeneralReport@dailyReport')->name('DailyReport');
		 	    	Route::get('/Monthly_Report','Sancofa\Setting\Report\GeneralReport@monthlyReport')->name('MonthlyReport');
		 	    	Route::get('/Yearly_Report','Sancofa\Setting\Report\GeneralReport@yearlyReport')->name('YearlyReport');
		 	    	Route::get('/General_Books_Report','Sancofa\Setting\Report\GeneralReport@generalBoksReport')->name('GeneralBooksReport');
		 	    	Route::get('/Books_Daily_Report','Sancofa\Setting\Report\GeneralReport@BooksDailyReport')->name('BookDailyReport');
		 	    	Route::get('/Book_Monthly_Report','Sancofa\Setting\Report\GeneralReport@BooksMonThlyReport')->name('BookMonthlyReport');
		 	    	Route::get('/Book_Yearly_Report','Sancofa\Setting\Report\GeneralReport@BooksYearlyReport')->name('BookYearlyReport');

		 	    });

	     });

    });
});


Auth::routes([

 'login'   => false,
 'register'=> false,
 'logout'  => false,

]);
