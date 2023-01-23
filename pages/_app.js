import '@/styles/globals.css'
import Layout from '../Layout' 
import { ApolloProvider } from '@apollo/client'

export default function App({ Component, pageProps }) {
  return (
    <Layout>
      <Component {...pageProps} /> 
    </Layout>
  )
}
