describe('Home Page Tests', () => {
  it('Visits the home page', () => {
    cy.visit('/')
  })

  it('Checks if the number of fixtures coffeeshops is equal to 10', () => {
    cy.get('[data-test="coffeeshop_title"]').should('have.length', 10)
  })
  it('Checks if the first coffeeshop is Le House', () => {
    cy.get('[data-test="coffeeshop_title"]').first().contains('Le House')
  })
  it('Verifies the nuxt_link', () => {
    cy.contains('Le House').click()
    cy.url().should('include', 'coffeeshops/1')
  })
})
