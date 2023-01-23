import Head from 'next/head'
import Image from 'next/image'
import { Inter } from '@next/font/google'
import styles from '@/styles/Home.module.css'
import { gql } from "@apollo/client";
import client from "../apollo-client";
const inter = Inter({ subsets: ['latin'] })

export default function Home({ countries }) {
  return (
  <>
    <h1>Hasan</h1>
  </>
  )
}