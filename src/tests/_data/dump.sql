create table users
(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name varchar(64) not null,
    email varchar(256) not null,
    created DATETIME not null,
    deleted DATETIME null,
    notes TEXT null
);

create unique index users_email_uindex
    on users (email);

create unique index users_name_uindex
    on users (name);


INSERT INTO users (name, email, created, deleted, notes) VALUES
 ('tcochran0', 'emckeighan0@mayoclinic.com', '2020-11-08 13:13:34', null, 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis.'),
 ('dkasperski1', 'skalkofen1@youtu.be', '2020-12-27 02:36:52', null, 'Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim.'),
 ('bgebbe2', 'ebrotherton2@salon.com', '2020-05-20 21:09:52', null, 'Pellentesque ultrices mattis odio. Donec vitae nisi. Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla.'),
 ('hkincla3', 'deliasson3@dion.ne.jp', '2020-08-09 03:14:30', null, 'Sed accumsan felis. Ut at dolor quis odio consequat varius. Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi. Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus.'),
 ('aalvey4', 'sbrunesco4@github.com', '2020-09-18 06:13:34', null, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus. Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae , Duis faucibus accumsan odio. Curabitur convallis. Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor.'),
 ('abalk5', 'cgilhool5@shareasale.com', '2020-11-26 22:00:18', null, 'In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat. Nulla nisl. Nunc nisl. Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.'),
 ('igonsalvo6', 'awillcox6@canalblog.com', '2020-05-05 06:32:58', '2020-06-26 15:56:28', 'Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.'),
 ('tshimmans7', 'apratty7@sun.com', '2021-01-07 20:28:09', null, 'Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis. Sed ante. Vivamus tortor.'),
 ('nhalgarth8', 'chappel8@parallels.com', '2020-06-18 00:14:25', null, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae , Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque. Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus. In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus. Suspendisse potenti.'),
 ('clarder9', 'zluthwood9@lycos.com', '2021-02-25 05:52:23', null, 'In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo. Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.'),
 ('ghartrighta', 'fmityakova@yellowbook.com', '2020-04-11 13:12:37', null, 'Maecenas ut massa quis augue luctus tincidunt.'),
 ('mlanchberyb', 'knorgateb@ca.gov', '2021-02-10 08:53:21', null, 'Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede. Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat.'),
 ('hdudgeonc', 'wcowoppec@blog.com', '2020-03-07 17:16:53', '2020-04-27 06:43:32', 'Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae , Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque. Duis bibendum. Morbi non quam nec dui luctus rutrum.'),
 ('fcoweupped', 'lglabachd@flavors.me', '2020-04-18 07:21:15', null, 'Mauris lacinia sapien quis libero. Nullam sit amet turpis elementum ligula vehicula consequat.'),
 ('dcummingse', 'grodwaye@state.tx.us', '2021-02-17 10:41:16', null, 'Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus. Phasellus in felis. Donec semper sapien a libero. Nam dui.'),
 ('unicelyf', 'jcluesf@scribd.com', '2020-07-31 06:43:07', null, 'Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis. Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.'),
 ('aabbisong', 'chimsworthg@cafepress.com', '2020-05-25 02:05:33', '2020-07-20 03:45:40', 'Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat. Nulla nisl. Nunc nisl. Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa.'),
 ('tarthurh', 'kquelchh@timesonline.co.uk', '2020-09-23 03:12:19', null, 'Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem. Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit. Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue.'),
 ('dgreensalli', 'mparrishi@wikimedia.org', '2020-09-17 16:21:32', '2021-01-22 23:29:59', 'Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede. Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat. Nulla nisl. Nunc nisl. Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus.'),
 ('aheddej', 'mgreenwoodj@reference.com', '2020-12-06 02:08:15', null, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae , Mauris viverra diam vitae quam.');