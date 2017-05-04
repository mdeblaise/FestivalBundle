@reset-schema

Feature: Actuality

    Scenario: No actuality
        Given I have no actuality
        When I ask for actualities list
        Then I should see 0 actuality

    Scenario: Test the chain lister
        Given I am visitor
        Then I have no actuality
        And there are the following fake actualities
            | title | contents | date | status |
            | FakeActuality1 | blabla | 2016/08/16 | v |
            | FakeActuality2 | blabla | 2016/08/16 | v |
            | FakeActuality3 | blabla | 2016/08/16 | v |
            | FakeActuality4 | blabla | 2016/08/16 | v |
            | FakeActuality5 | blabla | 2016/08/16 | v |
        When I ask for actualities list
        Then I received a list of fake actuality
        And I should see 5 actualities
        And I should see the title of actuality 4 is equals to 'FakeActuality4'

        Given the following CardActualities
            | uuid |
            | 00000000-0000-4444-aaaa-000000000000 |
            | 11111111-1111-4444-aaaa-111111111111 |
            | 22222222-2222-4444-aaaa-222222222222 |
            | 33333333-1111-4444-aaaa-333333333333 |
            | 44444444-1111-4444-aaaa-444444444444 |
            | 55555555-1111-4444-aaaa-555555555555 |
            | 66666666-1111-4444-aaaa-666666666666 |
            | 77777777-1111-4444-aaaa-777777777777 |
            | 88888888-1111-4444-aaaa-888888888888 |
            | 99999999-1111-4444-aaaa-999999999999 |
        And the following actualities:
            | title      | contents  | publishedAt         | status | card                                 |
            | Actuality1 | contents1 | 2016-08-20 00:00:00 | v      | 00000000-0000-4444-aaaa-000000000000 |
            | Actuality2 | contents2 | 2016-08-19 14:00:00 | v      | 11111111-1111-4444-aaaa-111111111111 |
            | Actuality3 | contents3 | 2016-08-19 10:00:00 | v      | 22222222-2222-4444-aaaa-222222222222 |
            | Actuality4 | contents4 | 2016-08-18 09:00:00 | v      | 33333333-1111-4444-aaaa-333333333333 |
            | Actuality5 | contents4 | 2016-08-12 08:00:00 | v      | 44444444-1111-4444-aaaa-444444444444 |
            | Actuality6 | contents6 | 2016-08-15 07:00:00 | v      | 55555555-1111-4444-aaaa-555555555555 |
            | Actuality7 | contents7 | 2016-08-16 06:00:00 | v      | 66666666-1111-4444-aaaa-666666666666 |
        Given I prepare the request (date = '2016-08-19 12:00:00', limit = '2')
        When I ask for actualities list
        Then I should see 2 actualities
        Given I prepare the request (date = '2016-08-19 12:00:00', limit = '4')
        When I ask for actualities list
        Then I received a list of real actuality
        And I should see 4 actuality
        And I should see the title of actuality 1 is equals to 'Actuality3'
        And I should see the title of actuality 2 is equals to 'Actuality4'
        And I should see the title of actuality 3 is equals to 'Actuality7'
        And I should see the title of actuality 4 is equals to 'Actuality6'

    Scenario: Test 3
        Given I am visitor
        And the following CardActualities
            | uuid |
            | 00000000-0000-4444-aaaa-000000000000 |
            | 11111111-1111-4444-aaaa-111111111111 |
            | 22222222-2222-4444-aaaa-222222222222 |
            | 33333333-3333-4444-aaaa-333333333333 |
            | 44444444-4444-4444-aaaa-444444444444 |
        And the following actualities:
            | title      | status | card                                 | publishedAt         |
            | Actuality1 | v      | 00000000-0000-4444-aaaa-000000000000 | 2016-08-01 01:00:00 |
            | Actuality2 | v      | 11111111-1111-4444-aaaa-111111111111 | 2016-08-01 02:00:00 |
            | Actuality3 | v      | 22222222-2222-4444-aaaa-222222222222 | 2016-08-01 03:00:00 |
            | Actuality4 | d      | 22222222-2222-4444-aaaa-222222222222 | 2016-08-01 03:00:00 |
            | Actuality5 | c      | 33333333-3333-4444-aaaa-333333333333 | 2016-08-01 00:00:00 |
            | Actuality6 | x      | 44444444-4444-4444-aaaa-444444444444 | 2016-08-01 00:00:00 |
        When I ask for actualities list
        Then I should see 3 actualities
        And I should see the title of actuality 1 is equals to 'Actuality3'
        And I should see the title of actuality 2 is equals to 'Actuality2'
        And I should see the title of actuality 3 is equals to 'Actuality1'
        Given I am admin
        When I ask for actualities list
        Then I should see 4 actualities
        And I should see the title of actuality 1 is equals to 'Actuality3'
        And I should see the title of actuality 2 is equals to 'Actuality2'
        And I should see the title of actuality 3 is equals to 'Actuality1'
        And I should see the uuid of actuality 4 is equals to '33333333-3333-4444-aaaa-333333333333'
