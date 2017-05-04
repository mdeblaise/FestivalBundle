@reset-schema

Feature: Exponent

    Scenario: No exponent
        Given I have no exponent
        When I ask for exponents list
        Then I should see 0 exponent

    Scenario: Test the chain lister
        Given I am visitor
        Then I have no exponent
        And there are the following fake exponents
            | name          | descriptif | status |
            | FakeExponent1 | blabla    | v      |
            | FakeExponent2 | blabla    | v      |
            | FakeExponent3 | blabla    | v      |
            | FakeExponent4 | blabla    | v      |
            | FakeExponent5 | blabla    | v      |
        When I ask for exponents list
        Then I received a list of fake exponent
        And I should see 5 exponents
        And I should see the name of exponent 4 is equals to 'FakeExponent4'

        Given the following Cardexponents
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
        And the following exponents:
            | name      | descriptif  | status | card                                 | univers |  edition |
            | Exponent1 | descriptif1 | v      | 00000000-0000-4444-aaaa-000000000000 | gk      |  2017    |
            | Exponent2 | descriptif2 | v      | 11111111-1111-4444-aaaa-111111111111 | gk      |  2017    |
            | Exponent3 | descriptif3 | v      | 22222222-2222-4444-aaaa-222222222222 | gk      |  2017    |
            | Exponent4 | descriptif4 | v      | 33333333-1111-4444-aaaa-333333333333 | gk      |  2017    |
            | Exponent5 | descriptif4 | v      | 44444444-1111-4444-aaaa-444444444444 | gk      |  2017    |
            | Exponent6 | descriptif6 | v      | 55555555-1111-4444-aaaa-555555555555 | gk      |  2017    |
            | Exponent7 | descriptif7 | v      | 66666666-1111-4444-aaaa-666666666666 | gk      |  2017    |
        Given I prepare the request
        When I ask for exponents list
        Then I received a list of real exponent
        And I should see 7 exponents
        And I should see the name of exponent 1 is equals to 'Exponent1'
        And I should see the name of exponent 2 is equals to 'Exponent2'
        And I should see the name of exponent 3 is equals to 'Exponent3'
        And I should see the name of exponent 4 is equals to 'Exponent4'

    Scenario: Test 3
        Given the following Cardexponents
            | uuid                                 |
            | 00000000-0000-4444-aaaa-000000000000 |
            | 11111111-1111-4444-aaaa-111111111111 |
            | 22222222-2222-4444-aaaa-222222222222 |
            | 33333333-3333-4444-aaaa-333333333333 |
            | 44444444-4444-4444-aaaa-444444444444 |
        And the following exponents:
            | name       | status | card                                 | univers |  edition |
            | Exponent1  | v      | 00000000-0000-4444-aaaa-000000000000 | gk      |  2017    |
            | Exponent2  | v      | 11111111-1111-4444-aaaa-111111111111 | gk      |  2017    |
            | Exponent3  | v      | 22222222-2222-4444-aaaa-222222222222 | gk      |  2017    |
            | Exponent4  | d      | 22222222-2222-4444-aaaa-222222222222 | gk      |  2017    |
            | Exponent5  | c      | 33333333-3333-4444-aaaa-333333333333 | gk      |  2017    |
            | Exponent6  | x      | 44444444-4444-4444-aaaa-444444444444 | gk      |  2017    |
        When I ask for exponents list
        Then I should see 3 exponents
        And I should see the name of exponent 1 is equals to 'Exponent1'
        And I should see the name of exponent 2 is equals to 'Exponent2'
        And I should see the name of exponent 3 is equals to 'Exponent3'
        Given I am admin
        When I ask for exponents list
        Then I should see 4 exponents
        And I should see the name of exponent 1 is equals to 'Exponent1'
        And I should see the name of exponent 2 is equals to 'Exponent2'
        And I should see the name of exponent 3 is equals to 'Exponent3'
        And I should see the uuid of exponent 4 is equals to '33333333-3333-4444-aaaa-333333333333'
