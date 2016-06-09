insert into tb_role
(
    role,
    name,
    abbreviation,
    description_html,
    rank,
    is_admin
)
-- Can't do "\copy from stdin with csv" because some of these descriptions have commas
values
(
    1,
    'Member',
    'MEM',
    NULL,
    1000,
    false
),
(
    2,
    'IT Officer',
    'IT',
    'The IT Officer maintains this website and the Musician''s Network''s server.',
    1,
    true
),
(
    3,
    'President',
    'PRES',
    'The President is the final word in all UTC matters.',
    10,
    true
),
(
    4,
    'Vice President',
    'VP',
    'The Vice President leads our weekly meetings. If you want to book practice time at Under the Couch, talk to the VP at the meeting or send an email to:<br /><br />utcpractice@gmail.com',
    15,
    true
),
(
    5,
    'Treasurer',
    'TREAS',
    'The Treasurer handles all of the finances of Musician''s Network and Under the Couch.',
    20,
    true
),
(
    6,
    'Secretary',
    'SEC',
    'The Secretary maintains the Under the Couch user database and records meeting minutes.',
    30,
    true
),
(
    7,
    'Minister of Propaganda',
    'MOP',
    'The Minister of Propaganda leads the advertising officers in spreading word of UTC events.',
    40,
    true
),
(
    8,
    'Advertising Officer',
    'AO',
    'Our Advertising Officers are here to spread the word about shows, events, and Musician''s Network membership. They manage and organize all forms of our advertising.',
    45,
    true
),
(
    9,
    'Booking Agent',
    'BA',
    'The Booking Agent books shows and events for Under the Couch.<br /><br />If you want to book a show or have questions about the process, visit the booking pages.',
    50,
    true
),
(
    10,
    'Open Mic Officer',
    'OM',
    'The Open Mic Officer runs our weekly Open Mic Nights.<br />For more information on Open Mic Night, click <a href="/info/openmic">here</a>.',
    60,
    true
),
(
    11,
    'General Manager',
    'GM',
    'The General Manager maintains the general upkeep of Under the Couch and oversees daytime functioning and staffing.',
    70,
    true
),
(
    12,
    'Equipment Manager',
    'EQM',
    'The Equipment Manager handles all of the equipment (soundboards, mics, etc.) of Under the Couch. Doubles as lead paranormal investigator.<br /><br />If you want to book recording time or have questions about the process, visit the <a href="/booking/record">recording page</a>.',
    80,
    true
),
(
    13,
    'Social Chair',
    'SC',
    'The Social Chair organizes monthly social events at the Under the Couch space and helps reach out to new members.',
    90,
    true
)
returning role;

-- Set parent for all non-Members so far to be Member
   update tb_role
      set parent = ( select role from tb_role where name = 'Member' )
    where name <> 'Member'
returning role;
