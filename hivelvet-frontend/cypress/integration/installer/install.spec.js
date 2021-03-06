describe('Test install process', () => {
    beforeEach(() => {
        cy.visit('/')
    })

    it('should loads correctly install wizard page', () => {
        cy.get('header').should('be.visible')
        cy.get('main').should('be.visible')
        cy.get('footer').should('be.visible')
        cy.get('.install-steps').should('exist')

        cy.checkExistFormFields('install')
    })

    it('should display errors when submitting empty step 1 form', () => {
        cy.checkEmptyForm('install')
    })

    it('should validate fields of step 1 form', () => {
        cy.checkInvalidForm('install')
    })

    it('should display errors when submitting empty step 2 form', () => {
        const fakeUsername = 'username'
        const fakeEmail = 'test@gmail.com'
        const fakePwd = 'password'

        cy.get('input#install_form_username').type(fakeUsername).should('have.value', fakeUsername)
        cy.get('input#install_form_email').type(fakeEmail).should('have.value', fakeEmail)
        cy.get('input#install_form_password').type(fakePwd).should('have.value', fakePwd)
        cy.get('button#submit-btn').click()

        cy.get('input#install_form_username').should('not.exist')
            .get('input#install_form_email').should('not.exist')
            .get('input#install_form_password').should('not.exist').then(() => {
                cy.get('form#install_form').should('exist').within(() => {
                    cy.get('button.prev').should('be.visible')

                    cy.get('input#install_form_company_name').clear().should('have.value', '')
                    cy.get('input#install_form_company_url').clear().should('have.value', '')
                    cy.get('input#install_form_platform_name').clear().should('have.value', '')
                    cy.get('button#submit-btn').click()

                    cy.get('input#install_form_company_name').parent().parent().parent().parent().get('div.ant-form-item-has-error').should('be.visible');
                    cy.get('input#install_form_company_url').parent().parent().parent().parent().get('div.ant-form-item-has-error').should('be.visible');
                    cy.get('input#install_form_platform_name').parent().parent().parent().parent().get('div.ant-form-item-has-error').should('be.visible');
                })
        })
    })
})