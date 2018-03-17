truncate table utility;
insert utility (utility_id, name, state_type_cd) values (1, 'Atlanta', 'GA');

truncate table toxin_type;
insert toxin_type values ('01', 'Bromodichloromethane', null);
insert toxin_type values ('02', 'Chloroform', null);
insert toxin_type values ('03', 'Chromium (hexavalent)', null);
insert toxin_type values ('04', 'Dibromochloromethane', null);
insert toxin_type values ('05', 'Dichloroacetic acid', null);
insert toxin_type values ('06', 'Total trihalomethanes (TTHMs)', null);
insert toxin_type values ('07', 'Trichloroacetic acid', null);

truncate table health_risk_type;
insert health_risk_type values ('01', 'Cancer', null);

truncate table filter_type;
insert filter_type values ('01', 'PUR Faucet Filter', null);
insert filter_type values ('02', '3M  AquaPure System', null);
insert filter_type values ('03', 'Custom Filter Required', null);

truncate table limit_type;
insert limit_type values ('01', 'Health', null);
insert limit_type values ('02', 'State', null);
insert limit_type values ('03', 'National', null);

truncate table average_type;
insert average_type values ('02', 'State', null);
insert average_type values ('03', 'National', null);

truncate table source_type;
insert source_type values ('01', 'Byproduct of Disinfection', null);
insert source_type values ('02', 'Industrial + Naturally Occuring', null);

truncate table toxin_limit;
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('01', '01', 0.4);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('01', '02', null);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('01', '03', null);

insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('02', '01', 1);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('02', '02', null);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('02', '03', null);

insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('03', '01', 0.02);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('03', '02', null);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('03', '03', null);

insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('04', '01', 0.7);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('04', '02', null);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('04', '03', null);

insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('05', '01', 0.7);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('05', '02', null);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('05', '03', null);

insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('06', '01', 0.8);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('06', '02', null);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('06', '03', 80);

insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('07', '01', 0.5);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('07', '02', null);
insert toxin_limit (toxin_type_cd, limit_type_cd, value) values ('07', '03', null);


truncate table toxin_average;
insert toxin_average (toxin_type_cd, average_type_cd, value) values ('01', '02', 1.79);
insert toxin_average (toxin_type_cd, average_type_cd, value) values ('01', '03', 4.31);

insert toxin_average (toxin_type_cd, average_type_cd, value) values ('02', '02', 6.67);
insert toxin_average (toxin_type_cd, average_type_cd, value) values ('02', '03', 11.2);

insert toxin_average (toxin_type_cd, average_type_cd, value) values ('03', '02', 0.142);
insert toxin_average (toxin_type_cd, average_type_cd, value) values ('03', '03', 0.797);

insert toxin_average (toxin_type_cd, average_type_cd, value) values ('04', '02', 0.714);
insert toxin_average (toxin_type_cd, average_type_cd, value) values ('04', '03', 0.296);

insert toxin_average (toxin_type_cd, average_type_cd, value) values ('05', '02', 3.19);
insert toxin_average (toxin_type_cd, average_type_cd, value) values ('05', '03', 6);

insert toxin_average (toxin_type_cd, average_type_cd, value) values ('06', '02', 11.8);
insert toxin_average (toxin_type_cd, average_type_cd, value) values ('06', '03', 23.2);

insert toxin_average (toxin_type_cd, average_type_cd, value) values ('07', '02', 3.66);
insert toxin_average (toxin_type_cd, average_type_cd, value) values ('07', '03', 4.92);

truncate zip_toxin_source;
insert zip_toxin_source (zip_toxin_source_id, zip_cd, toxin_type_cd, source_type_cd) values (1, '30308', '01', '01');
insert zip_toxin_source (zip_toxin_source_id, zip_cd, toxin_type_cd, source_type_cd) values (2, '30308', '02', '01');
insert zip_toxin_source (zip_toxin_source_id, zip_cd, toxin_type_cd, source_type_cd) values (3, '30308', '03', '02');
insert zip_toxin_source (zip_toxin_source_id, zip_cd, toxin_type_cd, source_type_cd) values (4, '30308', '04', '01');
insert zip_toxin_source (zip_toxin_source_id, zip_cd, toxin_type_cd, source_type_cd) values (5, '30308', '05', '01');
insert zip_toxin_source (zip_toxin_source_id, zip_cd, toxin_type_cd, source_type_cd) values (6, '30308', '06', '01');
insert zip_toxin_source (zip_toxin_source_id, zip_cd, toxin_type_cd, source_type_cd) values (7, '30308', '07', '01');

truncate table zip;
insert zip (zip_id, zip_cd, toxin_type_cd, health_risk_type_cd, filter_type_cd, amount, utility_id, sample_dtm) values (1, '30308', '01', '01', '01', 7.46, 1, '2018-03-17');
insert zip (zip_id, zip_cd, toxin_type_cd, health_risk_type_cd, filter_type_cd, amount, utility_id, sample_dtm) values (2, '30308', '02', '01', '01', 26.6, 1, '2018-03-17');
insert zip (zip_id, zip_cd, toxin_type_cd, health_risk_type_cd, filter_type_cd, amount, utility_id, sample_dtm) values (3, '30308', '03', '01', '02', 0.145, 1, '2018-03-17');
insert zip (zip_id, zip_cd, toxin_type_cd, health_risk_type_cd, filter_type_cd, amount, utility_id, sample_dtm) values (4, '30308', '04', '01', '03', 1.06, 1, '2018-03-17');
insert zip (zip_id, zip_cd, toxin_type_cd, health_risk_type_cd, filter_type_cd, amount, utility_id, sample_dtm) values (5, '30308', '05', '01', '03', 15.9, 1, '2018-03-17');
insert zip (zip_id, zip_cd, toxin_type_cd, health_risk_type_cd, filter_type_cd, amount, utility_id, sample_dtm) values (6, '30308', '06', '01', '02', 35.3, 1, '2018-03-17');
insert zip (zip_id, zip_cd, toxin_type_cd, health_risk_type_cd, filter_type_cd, amount, utility_id, sample_dtm) values (7, '30308', '07', '01', '03', 14.6, 1, '2018-03-17');



