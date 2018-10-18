/*insert into listing_demo ( list_heading, img, location, price, sqft, phone) 
    values ( 'smit', 'smit.jpg', 'oshawa', 5555, 5555, 9999999999);*/
/*SELECT setval('public.listing_demo_id_seq', (SELECT MAX(id) FROM listing_demo)+1);*/
/*SELECT MAX(id) FROM listing_demo;
pg_get_serial_sequence(table_name, column_name)	
SELECT nextval('7');*/
/*"public.listing_demo_id_seq"*/
/*SELECT 7 FROM listing_demo;*/
/* select pg_get_serial_sequence('listing_demo', 'id');*/
/*select nextval(pg_get_serial_sequence('listing_demo', 'id')) as new_id; // New ID is 7 // new_idbigint*/