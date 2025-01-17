USE [master]
GO
/****** Object:  Database [dbonlinelearning]    Script Date: 7/18/2024 5:08:40 PM ******/
CREATE DATABASE [dbonlinelearning]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'dbonlinelearning', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\dbonlinelearning.mdf' , SIZE = 73728KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'dbonlinelearning_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\dbonlinelearning_log.ldf' , SIZE = 73728KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [dbonlinelearning] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [dbonlinelearning].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [dbonlinelearning] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [dbonlinelearning] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [dbonlinelearning] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [dbonlinelearning] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [dbonlinelearning] SET ARITHABORT OFF 
GO
ALTER DATABASE [dbonlinelearning] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [dbonlinelearning] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [dbonlinelearning] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [dbonlinelearning] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [dbonlinelearning] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [dbonlinelearning] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [dbonlinelearning] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [dbonlinelearning] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [dbonlinelearning] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [dbonlinelearning] SET  DISABLE_BROKER 
GO
ALTER DATABASE [dbonlinelearning] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [dbonlinelearning] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [dbonlinelearning] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [dbonlinelearning] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [dbonlinelearning] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [dbonlinelearning] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [dbonlinelearning] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [dbonlinelearning] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [dbonlinelearning] SET  MULTI_USER 
GO
ALTER DATABASE [dbonlinelearning] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [dbonlinelearning] SET DB_CHAINING OFF 
GO
ALTER DATABASE [dbonlinelearning] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [dbonlinelearning] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [dbonlinelearning] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [dbonlinelearning] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [dbonlinelearning] SET QUERY_STORE = ON
GO
ALTER DATABASE [dbonlinelearning] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [dbonlinelearning]
GO
/****** Object:  Table [dbo].[answers]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[answers](
	[answerId] [int] IDENTITY(1,1) NOT NULL,
	[answer] [nvarchar](max) NULL,
	[questionId] [int] NOT NULL,
	[isCorrect] [bit] NOT NULL,
 CONSTRAINT [PK_answers] PRIMARY KEY CLUSTERED 
(
	[answerId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Chapter]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Chapter](
	[chapterId] [int] IDENTITY(1,1) NOT NULL,
	[chapterName] [varchar](255) NULL,
	[courseId] [int] NULL,
 CONSTRAINT [PK__Chapter__05D716CF0EA93619] PRIMARY KEY CLUSTERED 
(
	[chapterId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[course]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[course](
	[courseId] [int] IDENTITY(1,1) NOT NULL,
	[courseName] [nvarchar](50) NULL,
	[description] [nvarchar](max) NULL,
	[startDate] [date] NULL,
	[endDate] [date] NULL,
	[price] [numeric](5, 2) NULL,
	[numberOfParticipents] [nchar](10) NULL,
	[rating] [numeric](5, 2) NULL,
	[portalId] [int] NULL,
	[trainerId] [int] NULL,
	[numOfViews] [int] NULL,
 CONSTRAINT [PK_course] PRIMARY KEY CLUSTERED 
(
	[courseId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Lesson]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Lesson](
	[lessonId] [int] IDENTITY(1,1) NOT NULL,
	[lessonName] [varchar](255) NULL,
	[chapterId] [int] NULL,
	[videoPath] [nvarchar](max) NULL,
 CONSTRAINT [PK__Lesson__F88A9778204D24BB] PRIMARY KEY CLUSTERED 
(
	[lessonId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[participatedcourse]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[participatedcourse](
	[courseId] [int] NOT NULL,
	[participationId] [int] NOT NULL,
 CONSTRAINT [PK_participatedcourse] PRIMARY KEY CLUSTERED 
(
	[courseId] ASC,
	[participationId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[participation]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[participation](
	[participationId] [int] IDENTITY(1,1) NOT NULL,
	[participationDate] [date] NULL,
	[amount] [decimal](18, 0) NULL,
	[traineeId] [int] NOT NULL,
 CONSTRAINT [PK_participation] PRIMARY KEY CLUSTERED 
(
	[participationId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[portal]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[portal](
	[portalId] [int] IDENTITY(1,1) NOT NULL,
	[portalName] [varchar](50) NOT NULL,
	[isActive] [bit] NULL,
 CONSTRAINT [PK_portal] PRIMARY KEY CLUSTERED 
(
	[portalId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[questions]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[questions](
	[questionId] [int] IDENTITY(1,1) NOT NULL,
	[question] [nvarchar](max) NULL,
	[courseId] [int] NOT NULL,
 CONSTRAINT [PK_questions] PRIMARY KEY CLUSTERED 
(
	[questionId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[results]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[results](
	[resultId] [int] IDENTITY(1,1) NOT NULL,
	[score] [decimal](18, 0) NULL,
	[userId] [int] NOT NULL,
	[courseId] [int] NOT NULL,
 CONSTRAINT [PK_results] PRIMARY KEY CLUSTERED 
(
	[resultId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tblUser]    Script Date: 7/18/2024 5:08:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblUser](
	[userId] [int] IDENTITY(1,1) NOT NULL,
	[firstName] [nchar](10) NULL,
	[lastName] [nchar](10) NULL,
	[tel] [varchar](50) NULL,
	[email] [varchar](50) NULL,
	[userType] [char](2) NULL,
	[userName] [nchar](6) NULL,
	[password] [varchar](max) NULL,
	[isActive] [bit] NULL,
	[dateofbirth] [date] NULL,
	[startdate] [date] NULL,
	[experienceyears] [smallint] NULL,
	[imageUrl] [nvarchar](max) NULL,
 CONSTRAINT [PK_user] PRIMARY KEY CLUSTERED 
(
	[userId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
ALTER TABLE [dbo].[participation] ADD  CONSTRAINT [DF_participation_participationDate]  DEFAULT (getdate()) FOR [participationDate]
GO
ALTER TABLE [dbo].[participation] ADD  CONSTRAINT [DF_participation_amount]  DEFAULT ((0)) FOR [amount]
GO
ALTER TABLE [dbo].[portal] ADD  CONSTRAINT [DF_portal_isactive]  DEFAULT ((1)) FOR [isActive]
GO
ALTER TABLE [dbo].[tblUser] ADD  CONSTRAINT [DF_user_startdate]  DEFAULT (getdate()) FOR [startdate]
GO
ALTER TABLE [dbo].[answers]  WITH CHECK ADD  CONSTRAINT [FK_answers_questions] FOREIGN KEY([questionId])
REFERENCES [dbo].[questions] ([questionId])
GO
ALTER TABLE [dbo].[answers] CHECK CONSTRAINT [FK_answers_questions]
GO
ALTER TABLE [dbo].[Chapter]  WITH CHECK ADD  CONSTRAINT [courseId] FOREIGN KEY([courseId])
REFERENCES [dbo].[course] ([courseId])
GO
ALTER TABLE [dbo].[Chapter] CHECK CONSTRAINT [courseId]
GO
ALTER TABLE [dbo].[course]  WITH CHECK ADD  CONSTRAINT [FK_course_portal] FOREIGN KEY([portalId])
REFERENCES [dbo].[portal] ([portalId])
GO
ALTER TABLE [dbo].[course] CHECK CONSTRAINT [FK_course_portal]
GO
ALTER TABLE [dbo].[course]  WITH CHECK ADD  CONSTRAINT [FK_course_user] FOREIGN KEY([trainerId])
REFERENCES [dbo].[tblUser] ([userId])
GO
ALTER TABLE [dbo].[course] CHECK CONSTRAINT [FK_course_user]
GO
ALTER TABLE [dbo].[Lesson]  WITH CHECK ADD  CONSTRAINT [FK__Lesson__chapterI__5FB337D6] FOREIGN KEY([chapterId])
REFERENCES [dbo].[Chapter] ([chapterId])
GO
ALTER TABLE [dbo].[Lesson] CHECK CONSTRAINT [FK__Lesson__chapterI__5FB337D6]
GO
ALTER TABLE [dbo].[participatedcourse]  WITH CHECK ADD  CONSTRAINT [FK_participatedcourse_course] FOREIGN KEY([courseId])
REFERENCES [dbo].[course] ([courseId])
GO
ALTER TABLE [dbo].[participatedcourse] CHECK CONSTRAINT [FK_participatedcourse_course]
GO
ALTER TABLE [dbo].[participatedcourse]  WITH CHECK ADD  CONSTRAINT [FK_participatedcourse_participation] FOREIGN KEY([participationId])
REFERENCES [dbo].[participation] ([participationId])
GO
ALTER TABLE [dbo].[participatedcourse] CHECK CONSTRAINT [FK_participatedcourse_participation]
GO
ALTER TABLE [dbo].[participation]  WITH CHECK ADD  CONSTRAINT [FK_participation_tblUser] FOREIGN KEY([traineeId])
REFERENCES [dbo].[tblUser] ([userId])
GO
ALTER TABLE [dbo].[participation] CHECK CONSTRAINT [FK_participation_tblUser]
GO
ALTER TABLE [dbo].[questions]  WITH CHECK ADD  CONSTRAINT [FK_questions_course] FOREIGN KEY([courseId])
REFERENCES [dbo].[course] ([courseId])
GO
ALTER TABLE [dbo].[questions] CHECK CONSTRAINT [FK_questions_course]
GO
ALTER TABLE [dbo].[results]  WITH CHECK ADD  CONSTRAINT [FK_results_course] FOREIGN KEY([courseId])
REFERENCES [dbo].[course] ([courseId])
GO
ALTER TABLE [dbo].[results] CHECK CONSTRAINT [FK_results_course]
GO
ALTER TABLE [dbo].[results]  WITH CHECK ADD  CONSTRAINT [FK_results_tblUser] FOREIGN KEY([userId])
REFERENCES [dbo].[tblUser] ([userId])
GO
ALTER TABLE [dbo].[results] CHECK CONSTRAINT [FK_results_tblUser]
GO
USE [master]
GO
ALTER DATABASE [dbonlinelearning] SET  READ_WRITE 
GO
