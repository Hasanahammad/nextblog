import Head from 'next/head'
import parseHTML from "html-react-parser";
import Image from 'next/image'
import { Inter } from '@next/font/google'
import styles from '@/styles/Home.module.css'
import { gql } from "@apollo/client";
import client from "../apollo-client";
const inter = Inter({ subsets: ['latin'] })
import { useState, useEffect } from 'react'
import Link from "next/link"

export const getStaticProps = async () => {
  // const API_URL = "https://jsonplaceholder.typicode.com/photos"
  const API_URL = "https://jsonplaceholder.typicode.com/posts"
  const request = await fetch(API_URL)
  const posts = await request.json()
  return { props: { posts } }
}

export default function Home({ posts }) {
  return (
    <div>
      <main>
        {posts.map(post => (
          <>
            <h1>{post.title}</h1>
            <p>{post.body}</p>
          </>
        ))}
      </main>
    </div>
  )
}


/*****For call button api */
/*

export default function Home() {
  const callAPI = async () => {
    try {
      const res = await fetch(
        `https://jsonplaceholder.typicode.com/posts/1`
      );
      const data = await res.json();
      console.log(data);
    } catch (err) {
      console.log(err);
    }
  };
  return (
    <div className={styles.container}>
      <main className={styles.main}>
        <button onClick={callAPI}>Make API Call</button>
      </main>
    </div>
  );
}


*/


/*****For rest api */
/*



export default function Home({ posts }) {
  console.log(posts);
  return (
    <div>
      <h1>Home Page</h1>
      {
        posts.nodes.map(post => {
          return (
            <>
              <Head>
                <title>{post.title}</title>
              </Head>
              <article>
                <header className={styles.header}>
                  <h1 className={styles.title}>{post.title}</h1>
                </header>
                <div className={styles.content}>{parseHTML(post.content)}</div>
              </article>
            </>
          )
        })
      }
    </div>
  )
}

export async function getStaticProps() {
  const res = await fetch('http://localhost/next/graphql', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      query: `
        query MyQuery2 {
          posts {
            nodes {
              slug
              title
              content(format: RENDERED)
            }
          }
        }
        `,
    })
  })

  const json = await res.json()

  return {
    props: {
      posts: json.data.posts,
    }
  }

}

*/