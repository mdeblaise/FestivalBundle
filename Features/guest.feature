Feature: Guest

@reset-schema
   Scenario: No fake guest
        Given I have no guest
        When I ask for guests list
        Then I should see 0 guest

    Scenario: Test the chain lister
        Given I have no guest
        And there are the following fake guests
            | name       | guestOfHonor | thisFriday | thisSaturday | thisSunday |
            | FakeGuest1 |  1           | 1          | 1            | 1          |
            | FakeGuest2 |  1           | 1          | 1            | 0          |
            | FakeGuest3 |  1           | 1          | 0            | 0          |
            | FakeGuest4 |  1           | 0          | 0            | 0          |
            | FakeGuest5 |  1           | 1          | 0            | 1          |
        When I ask for guests list
        Then I received a list of fake guest
        And I should see 5 guests
        And I should see the name of guest 4 is equals to 'FakeGuest4'

    Scenario: Load fixtures
        Given the following CardGuest
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
            | 11111111-0000-4444-aaaa-000000000000 |
            | 22222222-0000-4444-aaaa-000000000000 |
            | 33333333-0000-4444-aaaa-000000000000 |
            | 44444444-0000-4444-aaaa-000000000000 |
            | 55555555-0000-4444-aaaa-000000000000 |
        And the following guests:
            | name         | guestOfHonor | thisFriday | thisSaturday | thisSunday | univers |  edition | status | card                                 |
            | Gandalf      |  1           | 1          | 1            | 1          | gk      |  2017    | v      | 00000000-0000-4444-aaaa-000000000000 |
            | Sarouman     |  0           | 0          | 0            | 0          | gk      |  2017    | v      | 11111111-1111-4444-aaaa-111111111111 |
            | Elrond       |  0           | 0          | 1            | 1          | td      |  2017    | v      | 22222222-2222-4444-aaaa-222222222222 |
            | Merry        |  0           | 0          | 1            | 0          | mg      |  2017    | v      | 33333333-1111-4444-aaaa-333333333333 |
            | Pippin       |  1           | 0          | 1            | 0          | mg      |  2017    | v      | 44444444-1111-4444-aaaa-444444444444 |
            | Sam          |  1           | 1          | 1            | 1          | mg      |  2017    | v      | 55555555-1111-4444-aaaa-555555555555 |
            | Frodo        |  1           | 0          | 1            | 1          | mg      |  2017    | v      | 66666666-1111-4444-aaaa-666666666666 |
            | Bilbo        |  0           | 0          | 1            | 1          | mg      |  2017    | v      | 77777777-1111-4444-aaaa-777777777777 |
            | Boromir      |  0           | 0          | 0            | 1          | gk      |  2017    | v      | 88888888-1111-4444-aaaa-888888888888 |
            | Aragorn      |  1           | 0          | 1            | 0          | gk      |  2017    | v      | 99999999-1111-4444-aaaa-999999999999 |
            | Legolas      |  1           | 1          | 1            | 1          | td      |  2017    | v      | 11111111-0000-4444-aaaa-000000000000 |
            | Gimli        |  0           | 1          | 1            | 1          | gk      |  2017    | v      | 22222222-0000-4444-aaaa-000000000000 |
            | Arwen        |  0           | 0          | 1            | 0          | td      |  2017    | v      | 33333333-0000-4444-aaaa-000000000000 |
            | Galadriel    |  0           | 1          | 1            | 1          | td      |  2017    | v      | 44444444-0000-4444-aaaa-000000000000 |
            | Tom Bombadil |  1           | 0          | 0            | 1          | gk      |  2017    | v      | 55555555-0000-4444-aaaa-000000000000 |

    Scenario: No special filter
        When I ask for guests list
        Then I should see 15 guests
        And I should see the name of guest 1 is equals to 'Aragorn'
        And I should see the name of guest 15 is equals to 'Sarouman'

    Scenario: Test paginate
        Given I prepare the request
        And I want to see max 6 guests per page
        When I ask for guests list
        Then I should see 6 guests
        And I should count 3 pages
        And I should count 15 guests
        Given I want to see the page number 3
        When I ask for guests list
        Then I should see 3 guests
        Then I should count 15 guests
        Given I want to see the page number 4
        When I ask for guests list
        Then I have got an exception
        And I have got an exception of type 'Pagerfanta\Exception\OutOfRangeCurrentPageException'

    Scenario: Only honor guests
        Given I prepare the request
        And I want to see just honor guest
        When I ask for guests list
        Then I should count 7 guests

    Scenario: Only guests present on friday
        Given I prepare the request
        And I want to see guests who are present on Friday
        When I ask for guests list
        Then I should count 5 guests

    Scenario: Only guests present on saturday
        Given I prepare the request
        And I want to see guests who are present on Saturday
        When I ask for guests list
        Then I should count 12 guests

    Scenario: Only guests present on sunday
        Given I prepare the request
        And I want to see guests who are present on Sunday
        When I ask for guests list
        Then I should count 10 guests

    Scenario: Only guests of the manga univers
        Given I prepare the request
        And I want to see guests on the 'mg' univers
        When I ask for guests list
        Then I should count 5 guests

    Scenario: Only guests of the geek univers
        Given I prepare the request
        And I want to see guests on the 'gk' univers
        When I ask for guests list
        Then I should count 6 guests

    Scenario: Only guests of the tradition univers
        Given I prepare the request
        And I want to see guests on the 'td' univers
        When I ask for guests list
        Then I should count 4 guests

    Scenario: Multiple choice
        Given I prepare the request
        And I want to see guests on the 'gk' univers
        And I want to see just honor guest
        And I want to see guests who are present on Saturday
        When I ask for guests list
        Then I should count 2 guests
        Given I want to see guests who are present on Sunday
        When I ask for guests list
        Then I should count 1 guest
        And I should see the name of guest 1 is equals to 'Gandalf'

@reset-schema
    Scenario: Test 3

        Given the following CardGuest
            | uuid                                 |
            | 00000000-0000-4444-aaaa-000000000000 |
            | 11111111-1111-4444-aaaa-111111111111 |
            | 22222222-2222-4444-aaaa-222222222222 |
            | 33333333-3333-4444-aaaa-333333333333 |
            | 44444444-4444-4444-aaaa-444444444444 |
        And the following guests:
            | name       | status | card                                 | univers |  edition    |
            | Guest1     | v      | 00000000-0000-4444-aaaa-000000000000 | gk      |  2017    |
            | Guest2     | v      | 11111111-1111-4444-aaaa-111111111111 | gk      |  2017    |
            | Guest3     | v      | 22222222-2222-4444-aaaa-222222222222 | gk      |  2017    |
            | Guest4     | d      | 22222222-2222-4444-aaaa-222222222222 | gk      |  2017    |
            | Guest5     | c      | 33333333-3333-4444-aaaa-333333333333 | gk      |  2017    |
            | Guest6     | x      | 44444444-4444-4444-aaaa-444444444444 | gk      |  2017    |
        When I ask for guests list
        Then I should see 3 guests
        And I should see the name of guest 1 is equals to 'Guest1'
        And I should see the name of guest 2 is equals to 'Guest2'
        And I should see the name of guest 3 is equals to 'Guest3'
        Given I am admin
        When I ask for guests list
        Then I should see 4 guests
        And I should see the name of guest 1 is equals to 'Guest1'
        And I should see the name of guest 2 is equals to 'Guest2'
        And I should see the name of guest 3 is equals to 'Guest3'
        And I should see the uuid of guest 4 is equals to '33333333-3333-4444-aaaa-333333333333'
