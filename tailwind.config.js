/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './front-page.php',
    './header.php',
    './index.php',
    './footer.php',
    './404.php',
    './inc/*.php',
    './page-templates/**/*.php',
    './template-parts/**/*.php',
    './woocommerce/**/*.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        barlow: ['Barlow', 'sans-serif'],
        barlowSemiCondensed: ['barlow-semi-condensed', 'sans-serif'],
      },
      spacing: {
        'pt-combo-sm': '130px', // 48 + 82
        'pt-combo-md': '168px', // 64 + 104
        'pt-combo-xl': '202px', // 96 + 106
      },
      colors: {
        dark: '#0D0D0D',
        accent: '#C93',
        background: '#E6E6E6',
        blockText: '#373737',
        blockTextLight: '#CBCBCB',
        formFields: '#F6F6F6',
        importantLinks: '#CC332E',
      },
      transitionTimingFunction: {
        //'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
      },
      gridTemplateRows: {
        // Allow grid rows to auto size based on content
        'masonry': 'masonry',
      },
    },
  },
  plugins: [
  ],
}